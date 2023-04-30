<?php
class Query
{
   private static $instance;
   private static $fields = [];
   private static $from = [];
   private static $conditions = [];
   public static function getInstance()
   {
      if (!self::$instance) {
         self::$instance = new self;
      }
      return self::$instance;
   }
   public static function select(string ...$fields): self
   {
      foreach ($fields as $field) {
         Query::$fields[] = $field;
      }
      return self::$instance;
   }
   public static function from(string $table, ?string $alias = null): self
   {
      Query::$from[] = $alias === null ? $table : "${table} AS ${alias}";
      return self::$instance;
   }
   public static function fetch(): array
   {
      $sql = '';
      $fields = (is_array(Query::$fields) ? implode(',', Query::$fields) : Query::$fields);
      $from = (is_array(Query::$from) ? implode(',', Query::$from) : Query::$from);
      $conditions = (is_array(Query::$conditions) ? implode(' AND ', Query::$conditions) : Query::$conditions);
      $sql = 'SELECT ' . $fields
         . ' FROM ' . $from . (Query::$conditions === [] ? '' : ' WHERE ' . $conditions);
      echo $sql;
      return Db::getInstance()->Execute($sql);
   }
   public static function where(string ...$where): self
   {
      foreach ($where as $arg) {
         Query::$conditions[] = $arg;
      }
      return self::$instance;
   }
   public static function fetchAll(): array
   {
      $sql = '';
      // print_r(Query::$fields);
      $fields = (is_array(Query::$fields) ? implode(',', Query::$fields) : Query::$fields);
      $from = (is_array(Query::$from) ? implode(',', Query::$from) : Query::$from);
      $conditions = (is_array(Query::$conditions) ? implode(' AND ', Query::$conditions) : Query::$conditions);
      $sql = 'SELECT ' . $fields
         . ' FROM ' . $from . (Query::$conditions === [] ? '' : ' WHERE ' . $conditions);
      echo '<br><br>' . $sql;
      return Db::getInstance()->ExecuteS($sql);
   }
}
