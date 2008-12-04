<?php

class UNL_MediaYak_OutputController
{
    static $output_template       = array();
    
    static $template_path         = '';
    
    static $directory_separator   = '_';
    
    static $classname_replacement = 'UNL_MediaYak_';
    
    static protected $cache;
    
    static function display($mixed, $return = false)
    {
        if (is_array($mixed)) {
            return self::displayArray($mixed, $return);
        }
        
        if (is_object($mixed)) {
            return self::displayObject($mixed, $return);
        }
        
        if ($return) {
            return $mixed;
        }
        
        echo $mixed;
        return true;
    }
    
    static public function setCacheInterface(UNL_MediaYak_CacheInterface $cache)
    {
        self::$cache = $cache;
    }
    
    static function displayArray($mixed, $return = false)
    {
        $output = '';
        foreach ($mixed as $m) {
            if ($return) {
                $output .= self::display($m, true);
            } else {
                self::display($m, true);
            }
        }
        
        if ($return) {
            return $output;
        }
        
        return true;
    }
    
    static function displayObject($object, $return = false)
    {
        if (method_exists($object, 'getCacheKey')
            && method_exists($object, 'run')) {
            $key = $object->getCacheKey();
            
            // We have a valid key to store the output of this object.
            if ($key !== false && $data = self::$cache->get($key)) {
                // Tell the object we have cached data and will output that.
                $object->preRun(true);
            } else {
                // Content should be cached, but none could be found.
                ob_start();
                $object->preRun(false);
                $object->run();
                self::sendObjectOutput($object, $return);
                $data = ob_get_contents();
                self::$cache->save($data);
                ob_end_clean();
            }
            
            $data = $object->postRun($data);
            
            if ($return) {
                return $data;
            }
            
            echo $data;
            return true;
        }
        return self::sendObjectOutput($object, $return);

    }
    
    static protected function sendObjectOutput($object, $return = false)
    {
        include_once 'Savant3.php';
        $savant = new Savant3();
        foreach (get_object_vars($object) as $key=>$var) {
            $savant->$key = $var;
        }
        if (in_array('ArrayAccess', class_implements($object))) {
            foreach ($object->toArray() as $key=>$var) {
                $savant->$key = $var;
            }
        }
        $templatefile = self::getTemplateFilename(get_class($object));
        if (file_exists($templatefile)) {
            if ($return) {
                flush();
                ob_start();
                $savant->display($templatefile);
                return ob_get_clean();
            }
            $savant->display($templatefile);
            return true;
        }
        
        throw new Exception('Sorry, '.$templatefile.' was not found.');
    }
    
    static function getTemplateFilename($class)
    {
        if (isset(self::$output_template[$class])) {
            $class = self::$output_template[$class];
        }
        
        $class = str_replace(array(self::$classname_replacement,
                                   self::$directory_separator),
                             array('',
                                   DIRECTORY_SEPARATOR),
                             $class);
        
        if (!empty(self::$template_path)) {
            $templatefile = self::$template_path
                          . DIRECTORY_SEPARATOR . $class . '.tpl.php';
        } else {
            $templatefile = 'templates' . DIRECTORY_SEPARATOR
                          . $class . '.tpl.php';
        }
        
        return $templatefile;
    }
    
    static public function setOutputTemplate($cname, $templatename)
    {
        if (isset($templatename)) {
            self::$output_template[$cname] = $templatename;
        }
        return self::getTemplateFilename($cname);
    }
    
    static public function setDirectorySeparator($separator)
    {
        self::$directory_separator = $separator;
    }
    
    static public function setClassNameReplacement($replacement)
    {
        self::$classname_replacement = $replacement;
    }
}

?>