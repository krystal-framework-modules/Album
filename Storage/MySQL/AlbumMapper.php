<?php

namespace Album\Storage\MySQL;

use Krystal\Db\Sql\AbstractMapper;

final class AlbumMapper extends AbstractMapper
{
    /**
     * {@inheritDoc}
     */
    public static function getTableName()
    {
        return self::getWithPrefix('users_album');
    }

    /**
     * Returns primary column name for current mapper
     * 
     * @return string
     */
    protected function getPk()
    {
        return 'id';
    }

    /**
     * Deletes photo by its id
     * 
     * @param int $id Photo id
     * @param int $userId User id
     * @return boolean
     */
    public function delete($id, $userId)
    {
        $db = $this->db->delete()
                       ->from(self::getTableName())
                       ->whereEquals('id', $id)
                       ->andWhereEquals('user_id', $userId);

        return (bool) $db->execute(true);
    }

    /**
     * Fetch all photos by user id
     * 
     * @param int $userId
     * @return array
     */
    public function fetchAll($userId)
    {
        $db = $this->db->select('*')
                       ->from(self::getTableName())
                       ->whereEquals('user_id', $userId)
                       ->orderBy('id')
                       ->desc();

        return $db->queryAll();
    }
}
