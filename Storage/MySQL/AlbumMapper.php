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
}
