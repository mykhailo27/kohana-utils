<?php
namespace BetaKiller\Utils\Kohana\ORM;

use BetaKiller\Exception;
use BetaKiller\Utils\Kohana\ORM;
use Database_Result;
use Validation;
use ORM_Validation_Exception;

interface OrmQueryBuilderInterface
{
    /**
     * Alias of and_where()
     *
     * @param   mixed   $column  column name or array($column, $alias) or object
     * @param   string  $op      logic operator
     * @param   mixed   $value   column value
     * @return  $this
     */
    public function where($column, $op, $value);

    /**
     * Creates a new "AND WHERE" condition for the query.
     *
     * @param   mixed   $column  column name or array($column, $alias) or object
     * @param   string  $op      logic operator
     * @param   mixed   $value   column value
     * @return  $this
     */
    public function and_where($column, $op, $value);

    /**
     * Creates a new "OR WHERE" condition for the query.
     *
     * @param   mixed   $column  column name or array($column, $alias) or object
     * @param   string  $op      logic operator
     * @param   mixed   $value   column value
     * @return  $this
     */
    public function or_where($column, $op, $value);

    /**
     * Alias of and_where_open()
     *
     * @return  $this
     */
    public function where_open();

    /**
     * Opens a new "AND WHERE (...)" grouping.
     *
     * @return  $this
     */
    public function and_where_open();

    /**
     * Opens a new "OR WHERE (...)" grouping.
     *
     * @return  $this
     */
    public function or_where_open();

    /**
     * Closes an open "AND WHERE (...)" grouping.
     *
     * @return  $this
     */
    public function where_close();

    /**
     * Closes an open "AND WHERE (...)" grouping.
     *
     * @return  $this
     */
    public function and_where_close();

    /**
     * Closes an open "OR WHERE (...)" grouping.
     *
     * @return  $this
     */
    public function or_where_close();

    /**
     * Applies sorting with "ORDER BY ..."
     *
     * @param   mixed   $column     column name or array($column, $alias) or object
     * @param   string  $direction  direction of sorting
     * @return  $this
     */
    public function order_by($column, $direction = NULL);

    /**
     * Return up to "LIMIT ..." results
     *
     * @param   integer  $number  maximum results to return
     * @return  $this
     */
    public function limit($number);

    /**
     * Enables or disables selecting only unique columns using "SELECT DISTINCT"
     *
     * @param   boolean  $value  enable or disable distinct columns
     * @return  $this
     */
    public function distinct($value);

    /**
     * Choose the columns to select from.
     *
     * @param   mixed  $columns  column name or array($column, $alias) or object
     * @param   ...
     * @return  $this
     */
    public function select($columns = NULL);

    /**
     * Choose the tables to select "FROM ..."
     *
     * @param   mixed  $tables  table name or array($table, $alias) or object
     * @param   ...
     * @return  $this
     */
    public function from($tables);

    /**
     * Adds addition tables to "JOIN ...".
     *
     * @param   mixed   $table  column name or array($column, $alias) or object
     * @param   string  $type   join type (LEFT, RIGHT, INNER, etc)
     * @return  $this
     */
    public function join($table, $type = NULL);

    /**
     * Adds "ON ..." conditions for the last created JOIN statement.
     *
     * @param   mixed   $c1  column name or array($column, $alias) or object
     * @param   string  $op  logic operator
     * @param   mixed   $c2  column name or array($column, $alias) or object
     * @return  $this
     */
    public function on($c1, $op, $c2);

    /**
     * Adds "USING ..." conditions for the last created JOIN statement.
     *
     * @param   string  $columns  column name
     * @return  $this
     */
    public function using($columns);

    /**
     * Creates a "GROUP BY ..." filter.
     *
     * @param   mixed   $columns  column name or array($column, $alias) or object
     * @param   ...
     * @return  $this
     */
    public function group_by($columns);

    /**
     * Alias of and_having()
     *
     * @param   mixed   $column  column name or array($column, $alias) or object
     * @param   string  $op      logic operator
     * @param   mixed   $value   column value
     * @return  $this|OrmInterface
     */
    public function having($column, $op, $value = NULL);

    /**
     * Creates a new "AND HAVING" condition for the query.
     *
     * @param   mixed   $column  column name or array($column, $alias) or object
     * @param   string  $op      logic operator
     * @param   mixed   $value   column value
     * @return  $this
     */
    public function and_having($column, $op, $value = NULL);

    /**
     * Creates a new "OR HAVING" condition for the query.
     *
     * @param   mixed   $column  column name or array($column, $alias) or object
     * @param   string  $op      logic operator
     * @param   mixed   $value   column value
     * @return  $this
     */
    public function or_having($column, $op, $value = NULL);

    /**
     * Alias of and_having_open()
     *
     * @return  $this
     */
    public function having_open();

    /**
     * Opens a new "AND HAVING (...)" grouping.
     *
     * @return  $this
     */
    public function and_having_open();

    /**
     * Opens a new "OR HAVING (...)" grouping.
     *
     * @return  $this
     */
    public function or_having_open();

    /**
     * Closes an open "AND HAVING (...)" grouping.
     *
     * @return  $this
     */
    public function having_close();

    /**
     * Closes an open "AND HAVING (...)" grouping.
     *
     * @return  $this
     */
    public function and_having_close();

    /**
     * Closes an open "OR HAVING (...)" grouping.
     *
     * @return  $this
     */
    public function or_having_close();

    /**
     * Start returning results after "OFFSET ..."
     *
     * @param   integer   $number  starting result number
     * @return  $this
     */
    public function offset($number);

    /**
     * Enables the query to be cached for a specified amount of time.
     *
     * @param   integer  $lifetime  number of seconds to cache
     * @return  $this
     * @uses    Kohana::$cache_life
     */
    public function cached($lifetime = NULL);

    /**
     * Finds and loads a single database row into the object.
     *
     * @chainable
     * @throws Exception
     * @return $this
     */
    public function find();

    /**
     * Finds multiple database rows and returns an iterator of the rows found.
     *
     * @throws Exception
     * @return Database_Result
     */
    public function find_all();

    /**
     * Clears query builder.  Passing FALSE is useful to keep the existing
     * query conditions for another query.
     *
     * @param bool $next Pass FALSE to avoid resetting on the next call
     * @return ORM
     */
    public function reset($next = TRUE);

}