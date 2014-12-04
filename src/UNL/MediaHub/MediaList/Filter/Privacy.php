<?php
class UNL_MediaHub_MediaList_Filter_Privacy implements UNL_MediaHub_Filter
{
    /**
     * @var UNL_MediaHub_User
     */
    protected $user = NULL;
    
    function __construct(UNL_MediaHub_User $user = NULL)
    {
        $this->user = $user;
    }
    
    function apply(Doctrine_Query &$query)
    {
        $where = 'm.privacy = "PUBLIC"';
        
        if ($this->user) {
            $feeds = $this->user->getFeedIDs();
            
            if (!empty($feeds)) {
                //There is a chance that a user will not have any feeds, so account for that.
                $where = 'm.privacy = "PUBLIC" OR m.UNL_MediaHub_Feed_Media.feed_id IN (' . implode(',', $feeds) .')';
            }
        }
        
        $query->andWhere($where);
    }

    function getLabel()
    {
        return 'Privacy';
    }

    function getType()
    {
        return '';
    }

    function getValue()
    {
        return '';
    }

    function __toString()
    {
        return '';
    }

    public static function getDescription()
    {
        return 'Show only media that the current user has access to';
    }
}
