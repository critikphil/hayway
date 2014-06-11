<?php

class CommentsModel extends Model {

    function getComments ($_achievementId) 
    {
            
            $query = "SELECT 
                                    achievements_comments.*, users.first_name, users.last_name, users.id as user_id, users.fbid as user_fbid
                        FROM 
                                    achievements_comments
                        LEFT JOIN
                                    users
                            ON
                                    achievements_comments.user_id = users.id
                            WHERE 
                                    achievements_comments.achievement_id = :achievementId
                ";
            return $this->_db->doQueryAll($query, array('achievementId'=>$_achievementId));
    }
}
?>