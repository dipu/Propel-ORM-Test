<?php

namespace Base;

use \WpPostsQuery as ChildWpPostsQuery;
use \DateTime;
use \Exception;
use \PDO;
use Map\WpPostsTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Propel\Runtime\Util\PropelDateTime;

/**
 * Base class that represents a row from the 'wp_posts' table.
 *
 *
 *
* @package    propel.generator..Base
*/
abstract class WpPosts implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\WpPostsTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var boolean
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var boolean
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = array();

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = array();

    /**
     * The value for the id field.
     *
     * @var        string
     */
    protected $id;

    /**
     * The value for the post_author field.
     *
     * Note: this column has a database default value of: '0'
     * @var        string
     */
    protected $post_author;

    /**
     * The value for the post_date field.
     *
     * Note: this column has a database default value of: NULL
     * @var        \DateTime
     */
    protected $post_date;

    /**
     * The value for the post_date_gmt field.
     *
     * Note: this column has a database default value of: NULL
     * @var        \DateTime
     */
    protected $post_date_gmt;

    /**
     * The value for the post_content field.
     *
     * @var        string
     */
    protected $post_content;

    /**
     * The value for the post_title field.
     *
     * @var        string
     */
    protected $post_title;

    /**
     * The value for the post_excerpt field.
     *
     * @var        string
     */
    protected $post_excerpt;

    /**
     * The value for the post_status field.
     *
     * Note: this column has a database default value of: 'publish'
     * @var        string
     */
    protected $post_status;

    /**
     * The value for the comment_status field.
     *
     * Note: this column has a database default value of: 'open'
     * @var        string
     */
    protected $comment_status;

    /**
     * The value for the ping_status field.
     *
     * Note: this column has a database default value of: 'open'
     * @var        string
     */
    protected $ping_status;

    /**
     * The value for the post_password field.
     *
     * Note: this column has a database default value of: ''
     * @var        string
     */
    protected $post_password;

    /**
     * The value for the post_name field.
     *
     * Note: this column has a database default value of: ''
     * @var        string
     */
    protected $post_name;

    /**
     * The value for the to_ping field.
     *
     * @var        string
     */
    protected $to_ping;

    /**
     * The value for the pinged field.
     *
     * @var        string
     */
    protected $pinged;

    /**
     * The value for the post_modified field.
     *
     * Note: this column has a database default value of: NULL
     * @var        \DateTime
     */
    protected $post_modified;

    /**
     * The value for the post_modified_gmt field.
     *
     * Note: this column has a database default value of: NULL
     * @var        \DateTime
     */
    protected $post_modified_gmt;

    /**
     * The value for the post_content_filtered field.
     *
     * @var        string
     */
    protected $post_content_filtered;

    /**
     * The value for the post_parent field.
     *
     * Note: this column has a database default value of: '0'
     * @var        string
     */
    protected $post_parent;

    /**
     * The value for the guid field.
     *
     * Note: this column has a database default value of: ''
     * @var        string
     */
    protected $guid;

    /**
     * The value for the menu_order field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $menu_order;

    /**
     * The value for the post_type field.
     *
     * Note: this column has a database default value of: 'post'
     * @var        string
     */
    protected $post_type;

    /**
     * The value for the post_mime_type field.
     *
     * Note: this column has a database default value of: ''
     * @var        string
     */
    protected $post_mime_type;

    /**
     * The value for the comment_count field.
     *
     * Note: this column has a database default value of: '0'
     * @var        string
     */
    protected $comment_count;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * Applies default values to this object.
     * This method should be called from the object's constructor (or
     * equivalent initialization method).
     * @see __construct()
     */
    public function applyDefaultValues()
    {
        $this->post_author = '0';
        $this->post_date = PropelDateTime::newInstance(NULL, null, 'DateTime');
        $this->post_date_gmt = PropelDateTime::newInstance(NULL, null, 'DateTime');
        $this->post_status = 'publish';
        $this->comment_status = 'open';
        $this->ping_status = 'open';
        $this->post_password = '';
        $this->post_name = '';
        $this->post_modified = PropelDateTime::newInstance(NULL, null, 'DateTime');
        $this->post_modified_gmt = PropelDateTime::newInstance(NULL, null, 'DateTime');
        $this->post_parent = '0';
        $this->guid = '';
        $this->menu_order = 0;
        $this->post_type = 'post';
        $this->post_mime_type = '';
        $this->comment_count = '0';
    }

    /**
     * Initializes internal state of Base\WpPosts object.
     * @see applyDefaults()
     */
    public function __construct()
    {
        $this->applyDefaultValues();
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return boolean True if the object has been modified.
     */
    public function isModified()
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param  string  $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return boolean True if $col has been modified.
     */
    public function isColumnModified($col)
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns()
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return boolean true, if the object has never been persisted.
     */
    public function isNew()
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param boolean $b the state of the object.
     */
    public function setNew($b)
    {
        $this->new = (boolean) $b;
    }

    /**
     * Whether this object has been deleted.
     * @return boolean The deleted state of this object.
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param  boolean $b The deleted state of this object.
     * @return void
     */
    public function setDeleted($b)
    {
        $this->deleted = (boolean) $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param  string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified($col = null)
    {
        if (null !== $col) {
            if (isset($this->modifiedColumns[$col])) {
                unset($this->modifiedColumns[$col]);
            }
        } else {
            $this->modifiedColumns = array();
        }
    }

    /**
     * Compares this with another <code>WpPosts</code> instance.  If
     * <code>obj</code> is an instance of <code>WpPosts</code>, delegates to
     * <code>equals(WpPosts)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param  mixed   $obj The object to compare to.
     * @return boolean Whether equal to the object specified.
     */
    public function equals($obj)
    {
        if (!$obj instanceof static) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey() || null === $obj->getPrimaryKey()) {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns()
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param  string  $name The virtual column name
     * @return boolean
     */
    public function hasVirtualColumn($name)
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param  string $name The virtual column name
     * @return mixed
     *
     * @throws PropelException
     */
    public function getVirtualColumn($name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of inexistent virtual column %s.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name  The virtual column name
     * @param mixed  $value The value to give to the virtual column
     *
     * @return $this|WpPosts The current object, for fluid interface
     */
    public function setVirtualColumn($name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param  string  $msg
     * @param  int     $priority One of the Propel::LOG_* logging levels
     * @return boolean
     */
    protected function log($msg, $priority = Propel::LOG_INFO)
    {
        return Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param  mixed   $parser                 A AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param  boolean $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @return string  The exported data
     */
    public function exportTo($parser, $includeLazyLoadColumns = true)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray(TableMap::TYPE_PHPNAME, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     */
    public function __sleep()
    {
        $this->clearAllReferences();

        $cls = new \ReflectionClass($this);
        $propertyNames = [];
        $serializableProperties = array_diff($cls->getProperties(), $cls->getProperties(\ReflectionProperty::IS_STATIC));

        foreach($serializableProperties as $property) {
            $propertyNames[] = $property->getName();
        }

        return $propertyNames;
    }

    /**
     * Get the [id] column value.
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the [post_author] column value.
     *
     * @return string
     */
    public function getPostAuthor()
    {
        return $this->post_author;
    }

    /**
     * Get the [optionally formatted] temporal [post_date] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getPostDate($format = NULL)
    {
        if ($format === null) {
            return $this->post_date;
        } else {
            return $this->post_date instanceof \DateTime ? $this->post_date->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [post_date_gmt] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getPostDateGmt($format = NULL)
    {
        if ($format === null) {
            return $this->post_date_gmt;
        } else {
            return $this->post_date_gmt instanceof \DateTime ? $this->post_date_gmt->format($format) : null;
        }
    }

    /**
     * Get the [post_content] column value.
     *
     * @return string
     */
    public function getPostContent()
    {
        return $this->post_content;
    }

    /**
     * Get the [post_title] column value.
     *
     * @return string
     */
    public function getPostTitle()
    {
        return $this->post_title;
    }

    /**
     * Get the [post_excerpt] column value.
     *
     * @return string
     */
    public function getPostExcerpt()
    {
        return $this->post_excerpt;
    }

    /**
     * Get the [post_status] column value.
     *
     * @return string
     */
    public function getPostStatus()
    {
        return $this->post_status;
    }

    /**
     * Get the [comment_status] column value.
     *
     * @return string
     */
    public function getCommentStatus()
    {
        return $this->comment_status;
    }

    /**
     * Get the [ping_status] column value.
     *
     * @return string
     */
    public function getPingStatus()
    {
        return $this->ping_status;
    }

    /**
     * Get the [post_password] column value.
     *
     * @return string
     */
    public function getPostPassword()
    {
        return $this->post_password;
    }

    /**
     * Get the [post_name] column value.
     *
     * @return string
     */
    public function getPostName()
    {
        return $this->post_name;
    }

    /**
     * Get the [to_ping] column value.
     *
     * @return string
     */
    public function getToPing()
    {
        return $this->to_ping;
    }

    /**
     * Get the [pinged] column value.
     *
     * @return string
     */
    public function getPinged()
    {
        return $this->pinged;
    }

    /**
     * Get the [optionally formatted] temporal [post_modified] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getPostModified($format = NULL)
    {
        if ($format === null) {
            return $this->post_modified;
        } else {
            return $this->post_modified instanceof \DateTime ? $this->post_modified->format($format) : null;
        }
    }

    /**
     * Get the [optionally formatted] temporal [post_modified_gmt] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getPostModifiedGmt($format = NULL)
    {
        if ($format === null) {
            return $this->post_modified_gmt;
        } else {
            return $this->post_modified_gmt instanceof \DateTime ? $this->post_modified_gmt->format($format) : null;
        }
    }

    /**
     * Get the [post_content_filtered] column value.
     *
     * @return string
     */
    public function getPostContentFiltered()
    {
        return $this->post_content_filtered;
    }

    /**
     * Get the [post_parent] column value.
     *
     * @return string
     */
    public function getPostParent()
    {
        return $this->post_parent;
    }

    /**
     * Get the [guid] column value.
     *
     * @return string
     */
    public function getGuid()
    {
        return $this->guid;
    }

    /**
     * Get the [menu_order] column value.
     *
     * @return int
     */
    public function getMenuOrder()
    {
        return $this->menu_order;
    }

    /**
     * Get the [post_type] column value.
     *
     * @return string
     */
    public function getPostType()
    {
        return $this->post_type;
    }

    /**
     * Get the [post_mime_type] column value.
     *
     * @return string
     */
    public function getPostMimeType()
    {
        return $this->post_mime_type;
    }

    /**
     * Get the [comment_count] column value.
     *
     * @return string
     */
    public function getCommentCount()
    {
        return $this->comment_count;
    }

    /**
     * Set the value of [id] column.
     *
     * @param string $v new value
     * @return $this|\WpPosts The current object (for fluent API support)
     */
    public function setId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->id !== $v) {
            $this->id = $v;
            $this->modifiedColumns[WpPostsTableMap::COL_ID] = true;
        }

        return $this;
    } // setId()

    /**
     * Set the value of [post_author] column.
     *
     * @param string $v new value
     * @return $this|\WpPosts The current object (for fluent API support)
     */
    public function setPostAuthor($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->post_author !== $v) {
            $this->post_author = $v;
            $this->modifiedColumns[WpPostsTableMap::COL_POST_AUTHOR] = true;
        }

        return $this;
    } // setPostAuthor()

    /**
     * Sets the value of [post_date] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\WpPosts The current object (for fluent API support)
     */
    public function setPostDate($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->post_date !== null || $dt !== null) {
            if ( ($dt != $this->post_date) // normalized values don't match
                || ($dt->format('Y-m-d H:i:s') === NULL) // or the entered value matches the default
                 ) {
                $this->post_date = $dt === null ? null : clone $dt;
                $this->modifiedColumns[WpPostsTableMap::COL_POST_DATE] = true;
            }
        } // if either are not null

        return $this;
    } // setPostDate()

    /**
     * Sets the value of [post_date_gmt] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\WpPosts The current object (for fluent API support)
     */
    public function setPostDateGmt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->post_date_gmt !== null || $dt !== null) {
            if ( ($dt != $this->post_date_gmt) // normalized values don't match
                || ($dt->format('Y-m-d H:i:s') === NULL) // or the entered value matches the default
                 ) {
                $this->post_date_gmt = $dt === null ? null : clone $dt;
                $this->modifiedColumns[WpPostsTableMap::COL_POST_DATE_GMT] = true;
            }
        } // if either are not null

        return $this;
    } // setPostDateGmt()

    /**
     * Set the value of [post_content] column.
     *
     * @param string $v new value
     * @return $this|\WpPosts The current object (for fluent API support)
     */
    public function setPostContent($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->post_content !== $v) {
            $this->post_content = $v;
            $this->modifiedColumns[WpPostsTableMap::COL_POST_CONTENT] = true;
        }

        return $this;
    } // setPostContent()

    /**
     * Set the value of [post_title] column.
     *
     * @param string $v new value
     * @return $this|\WpPosts The current object (for fluent API support)
     */
    public function setPostTitle($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->post_title !== $v) {
            $this->post_title = $v;
            $this->modifiedColumns[WpPostsTableMap::COL_POST_TITLE] = true;
        }

        return $this;
    } // setPostTitle()

    /**
     * Set the value of [post_excerpt] column.
     *
     * @param string $v new value
     * @return $this|\WpPosts The current object (for fluent API support)
     */
    public function setPostExcerpt($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->post_excerpt !== $v) {
            $this->post_excerpt = $v;
            $this->modifiedColumns[WpPostsTableMap::COL_POST_EXCERPT] = true;
        }

        return $this;
    } // setPostExcerpt()

    /**
     * Set the value of [post_status] column.
     *
     * @param string $v new value
     * @return $this|\WpPosts The current object (for fluent API support)
     */
    public function setPostStatus($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->post_status !== $v) {
            $this->post_status = $v;
            $this->modifiedColumns[WpPostsTableMap::COL_POST_STATUS] = true;
        }

        return $this;
    } // setPostStatus()

    /**
     * Set the value of [comment_status] column.
     *
     * @param string $v new value
     * @return $this|\WpPosts The current object (for fluent API support)
     */
    public function setCommentStatus($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->comment_status !== $v) {
            $this->comment_status = $v;
            $this->modifiedColumns[WpPostsTableMap::COL_COMMENT_STATUS] = true;
        }

        return $this;
    } // setCommentStatus()

    /**
     * Set the value of [ping_status] column.
     *
     * @param string $v new value
     * @return $this|\WpPosts The current object (for fluent API support)
     */
    public function setPingStatus($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->ping_status !== $v) {
            $this->ping_status = $v;
            $this->modifiedColumns[WpPostsTableMap::COL_PING_STATUS] = true;
        }

        return $this;
    } // setPingStatus()

    /**
     * Set the value of [post_password] column.
     *
     * @param string $v new value
     * @return $this|\WpPosts The current object (for fluent API support)
     */
    public function setPostPassword($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->post_password !== $v) {
            $this->post_password = $v;
            $this->modifiedColumns[WpPostsTableMap::COL_POST_PASSWORD] = true;
        }

        return $this;
    } // setPostPassword()

    /**
     * Set the value of [post_name] column.
     *
     * @param string $v new value
     * @return $this|\WpPosts The current object (for fluent API support)
     */
    public function setPostName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->post_name !== $v) {
            $this->post_name = $v;
            $this->modifiedColumns[WpPostsTableMap::COL_POST_NAME] = true;
        }

        return $this;
    } // setPostName()

    /**
     * Set the value of [to_ping] column.
     *
     * @param string $v new value
     * @return $this|\WpPosts The current object (for fluent API support)
     */
    public function setToPing($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->to_ping !== $v) {
            $this->to_ping = $v;
            $this->modifiedColumns[WpPostsTableMap::COL_TO_PING] = true;
        }

        return $this;
    } // setToPing()

    /**
     * Set the value of [pinged] column.
     *
     * @param string $v new value
     * @return $this|\WpPosts The current object (for fluent API support)
     */
    public function setPinged($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->pinged !== $v) {
            $this->pinged = $v;
            $this->modifiedColumns[WpPostsTableMap::COL_PINGED] = true;
        }

        return $this;
    } // setPinged()

    /**
     * Sets the value of [post_modified] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\WpPosts The current object (for fluent API support)
     */
    public function setPostModified($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->post_modified !== null || $dt !== null) {
            if ( ($dt != $this->post_modified) // normalized values don't match
                || ($dt->format('Y-m-d H:i:s') === NULL) // or the entered value matches the default
                 ) {
                $this->post_modified = $dt === null ? null : clone $dt;
                $this->modifiedColumns[WpPostsTableMap::COL_POST_MODIFIED] = true;
            }
        } // if either are not null

        return $this;
    } // setPostModified()

    /**
     * Sets the value of [post_modified_gmt] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\WpPosts The current object (for fluent API support)
     */
    public function setPostModifiedGmt($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->post_modified_gmt !== null || $dt !== null) {
            if ( ($dt != $this->post_modified_gmt) // normalized values don't match
                || ($dt->format('Y-m-d H:i:s') === NULL) // or the entered value matches the default
                 ) {
                $this->post_modified_gmt = $dt === null ? null : clone $dt;
                $this->modifiedColumns[WpPostsTableMap::COL_POST_MODIFIED_GMT] = true;
            }
        } // if either are not null

        return $this;
    } // setPostModifiedGmt()

    /**
     * Set the value of [post_content_filtered] column.
     *
     * @param string $v new value
     * @return $this|\WpPosts The current object (for fluent API support)
     */
    public function setPostContentFiltered($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->post_content_filtered !== $v) {
            $this->post_content_filtered = $v;
            $this->modifiedColumns[WpPostsTableMap::COL_POST_CONTENT_FILTERED] = true;
        }

        return $this;
    } // setPostContentFiltered()

    /**
     * Set the value of [post_parent] column.
     *
     * @param string $v new value
     * @return $this|\WpPosts The current object (for fluent API support)
     */
    public function setPostParent($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->post_parent !== $v) {
            $this->post_parent = $v;
            $this->modifiedColumns[WpPostsTableMap::COL_POST_PARENT] = true;
        }

        return $this;
    } // setPostParent()

    /**
     * Set the value of [guid] column.
     *
     * @param string $v new value
     * @return $this|\WpPosts The current object (for fluent API support)
     */
    public function setGuid($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->guid !== $v) {
            $this->guid = $v;
            $this->modifiedColumns[WpPostsTableMap::COL_GUID] = true;
        }

        return $this;
    } // setGuid()

    /**
     * Set the value of [menu_order] column.
     *
     * @param int $v new value
     * @return $this|\WpPosts The current object (for fluent API support)
     */
    public function setMenuOrder($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->menu_order !== $v) {
            $this->menu_order = $v;
            $this->modifiedColumns[WpPostsTableMap::COL_MENU_ORDER] = true;
        }

        return $this;
    } // setMenuOrder()

    /**
     * Set the value of [post_type] column.
     *
     * @param string $v new value
     * @return $this|\WpPosts The current object (for fluent API support)
     */
    public function setPostType($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->post_type !== $v) {
            $this->post_type = $v;
            $this->modifiedColumns[WpPostsTableMap::COL_POST_TYPE] = true;
        }

        return $this;
    } // setPostType()

    /**
     * Set the value of [post_mime_type] column.
     *
     * @param string $v new value
     * @return $this|\WpPosts The current object (for fluent API support)
     */
    public function setPostMimeType($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->post_mime_type !== $v) {
            $this->post_mime_type = $v;
            $this->modifiedColumns[WpPostsTableMap::COL_POST_MIME_TYPE] = true;
        }

        return $this;
    } // setPostMimeType()

    /**
     * Set the value of [comment_count] column.
     *
     * @param string $v new value
     * @return $this|\WpPosts The current object (for fluent API support)
     */
    public function setCommentCount($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->comment_count !== $v) {
            $this->comment_count = $v;
            $this->modifiedColumns[WpPostsTableMap::COL_COMMENT_COUNT] = true;
        }

        return $this;
    } // setCommentCount()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
            if ($this->post_author !== '0') {
                return false;
            }

            if ($this->post_date && $this->post_date->format('Y-m-d H:i:s') !== NULL) {
                return false;
            }

            if ($this->post_date_gmt && $this->post_date_gmt->format('Y-m-d H:i:s') !== NULL) {
                return false;
            }

            if ($this->post_status !== 'publish') {
                return false;
            }

            if ($this->comment_status !== 'open') {
                return false;
            }

            if ($this->ping_status !== 'open') {
                return false;
            }

            if ($this->post_password !== '') {
                return false;
            }

            if ($this->post_name !== '') {
                return false;
            }

            if ($this->post_modified && $this->post_modified->format('Y-m-d H:i:s') !== NULL) {
                return false;
            }

            if ($this->post_modified_gmt && $this->post_modified_gmt->format('Y-m-d H:i:s') !== NULL) {
                return false;
            }

            if ($this->post_parent !== '0') {
                return false;
            }

            if ($this->guid !== '') {
                return false;
            }

            if ($this->menu_order !== 0) {
                return false;
            }

            if ($this->post_type !== 'post') {
                return false;
            }

            if ($this->post_mime_type !== '') {
                return false;
            }

            if ($this->comment_count !== '0') {
                return false;
            }

        // otherwise, everything was equal, so return TRUE
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array   $row       The row returned by DataFetcher->fetch().
     * @param int     $startcol  0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @param string  $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false, $indexType = TableMap::TYPE_NUM)
    {
        try {

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : WpPostsTableMap::translateFieldName('Id', TableMap::TYPE_PHPNAME, $indexType)];
            $this->id = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : WpPostsTableMap::translateFieldName('PostAuthor', TableMap::TYPE_PHPNAME, $indexType)];
            $this->post_author = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : WpPostsTableMap::translateFieldName('PostDate', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->post_date = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : WpPostsTableMap::translateFieldName('PostDateGmt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->post_date_gmt = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : WpPostsTableMap::translateFieldName('PostContent', TableMap::TYPE_PHPNAME, $indexType)];
            $this->post_content = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : WpPostsTableMap::translateFieldName('PostTitle', TableMap::TYPE_PHPNAME, $indexType)];
            $this->post_title = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : WpPostsTableMap::translateFieldName('PostExcerpt', TableMap::TYPE_PHPNAME, $indexType)];
            $this->post_excerpt = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : WpPostsTableMap::translateFieldName('PostStatus', TableMap::TYPE_PHPNAME, $indexType)];
            $this->post_status = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : WpPostsTableMap::translateFieldName('CommentStatus', TableMap::TYPE_PHPNAME, $indexType)];
            $this->comment_status = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : WpPostsTableMap::translateFieldName('PingStatus', TableMap::TYPE_PHPNAME, $indexType)];
            $this->ping_status = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : WpPostsTableMap::translateFieldName('PostPassword', TableMap::TYPE_PHPNAME, $indexType)];
            $this->post_password = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : WpPostsTableMap::translateFieldName('PostName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->post_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : WpPostsTableMap::translateFieldName('ToPing', TableMap::TYPE_PHPNAME, $indexType)];
            $this->to_ping = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 13 + $startcol : WpPostsTableMap::translateFieldName('Pinged', TableMap::TYPE_PHPNAME, $indexType)];
            $this->pinged = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 14 + $startcol : WpPostsTableMap::translateFieldName('PostModified', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->post_modified = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 15 + $startcol : WpPostsTableMap::translateFieldName('PostModifiedGmt', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->post_modified_gmt = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 16 + $startcol : WpPostsTableMap::translateFieldName('PostContentFiltered', TableMap::TYPE_PHPNAME, $indexType)];
            $this->post_content_filtered = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 17 + $startcol : WpPostsTableMap::translateFieldName('PostParent', TableMap::TYPE_PHPNAME, $indexType)];
            $this->post_parent = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 18 + $startcol : WpPostsTableMap::translateFieldName('Guid', TableMap::TYPE_PHPNAME, $indexType)];
            $this->guid = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 19 + $startcol : WpPostsTableMap::translateFieldName('MenuOrder', TableMap::TYPE_PHPNAME, $indexType)];
            $this->menu_order = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 20 + $startcol : WpPostsTableMap::translateFieldName('PostType', TableMap::TYPE_PHPNAME, $indexType)];
            $this->post_type = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 21 + $startcol : WpPostsTableMap::translateFieldName('PostMimeType', TableMap::TYPE_PHPNAME, $indexType)];
            $this->post_mime_type = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 22 + $startcol : WpPostsTableMap::translateFieldName('CommentCount', TableMap::TYPE_PHPNAME, $indexType)];
            $this->comment_count = (null !== $col) ? (string) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 23; // 23 = WpPostsTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\WpPosts'), 0, $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param      boolean $deep (optional) Whether to also de-associated any related objects.
     * @param      ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(WpPostsTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildWpPostsQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see WpPosts::setDeleted()
     * @see WpPosts::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(WpPostsTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildWpPostsQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $this->setDeleted(true);
            }
        });
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see doSave()
     */
    public function save(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(WpPostsTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $isInsert = $this->isNew();
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                WpPostsTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }

            return $affectedRows;
        });
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                    $affectedRows += 1;
                } else {
                    $affectedRows += $this->doUpdate($con);
                }
                $this->resetModified();
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @throws PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[WpPostsTableMap::COL_ID] = true;
        if (null !== $this->id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . WpPostsTableMap::COL_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(WpPostsTableMap::COL_ID)) {
            $modifiedColumns[':p' . $index++]  = 'ID';
        }
        if ($this->isColumnModified(WpPostsTableMap::COL_POST_AUTHOR)) {
            $modifiedColumns[':p' . $index++]  = 'post_author';
        }
        if ($this->isColumnModified(WpPostsTableMap::COL_POST_DATE)) {
            $modifiedColumns[':p' . $index++]  = 'post_date';
        }
        if ($this->isColumnModified(WpPostsTableMap::COL_POST_DATE_GMT)) {
            $modifiedColumns[':p' . $index++]  = 'post_date_gmt';
        }
        if ($this->isColumnModified(WpPostsTableMap::COL_POST_CONTENT)) {
            $modifiedColumns[':p' . $index++]  = 'post_content';
        }
        if ($this->isColumnModified(WpPostsTableMap::COL_POST_TITLE)) {
            $modifiedColumns[':p' . $index++]  = 'post_title';
        }
        if ($this->isColumnModified(WpPostsTableMap::COL_POST_EXCERPT)) {
            $modifiedColumns[':p' . $index++]  = 'post_excerpt';
        }
        if ($this->isColumnModified(WpPostsTableMap::COL_POST_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'post_status';
        }
        if ($this->isColumnModified(WpPostsTableMap::COL_COMMENT_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'comment_status';
        }
        if ($this->isColumnModified(WpPostsTableMap::COL_PING_STATUS)) {
            $modifiedColumns[':p' . $index++]  = 'ping_status';
        }
        if ($this->isColumnModified(WpPostsTableMap::COL_POST_PASSWORD)) {
            $modifiedColumns[':p' . $index++]  = 'post_password';
        }
        if ($this->isColumnModified(WpPostsTableMap::COL_POST_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'post_name';
        }
        if ($this->isColumnModified(WpPostsTableMap::COL_TO_PING)) {
            $modifiedColumns[':p' . $index++]  = 'to_ping';
        }
        if ($this->isColumnModified(WpPostsTableMap::COL_PINGED)) {
            $modifiedColumns[':p' . $index++]  = 'pinged';
        }
        if ($this->isColumnModified(WpPostsTableMap::COL_POST_MODIFIED)) {
            $modifiedColumns[':p' . $index++]  = 'post_modified';
        }
        if ($this->isColumnModified(WpPostsTableMap::COL_POST_MODIFIED_GMT)) {
            $modifiedColumns[':p' . $index++]  = 'post_modified_gmt';
        }
        if ($this->isColumnModified(WpPostsTableMap::COL_POST_CONTENT_FILTERED)) {
            $modifiedColumns[':p' . $index++]  = 'post_content_filtered';
        }
        if ($this->isColumnModified(WpPostsTableMap::COL_POST_PARENT)) {
            $modifiedColumns[':p' . $index++]  = 'post_parent';
        }
        if ($this->isColumnModified(WpPostsTableMap::COL_GUID)) {
            $modifiedColumns[':p' . $index++]  = 'guid';
        }
        if ($this->isColumnModified(WpPostsTableMap::COL_MENU_ORDER)) {
            $modifiedColumns[':p' . $index++]  = 'menu_order';
        }
        if ($this->isColumnModified(WpPostsTableMap::COL_POST_TYPE)) {
            $modifiedColumns[':p' . $index++]  = 'post_type';
        }
        if ($this->isColumnModified(WpPostsTableMap::COL_POST_MIME_TYPE)) {
            $modifiedColumns[':p' . $index++]  = 'post_mime_type';
        }
        if ($this->isColumnModified(WpPostsTableMap::COL_COMMENT_COUNT)) {
            $modifiedColumns[':p' . $index++]  = 'comment_count';
        }

        $sql = sprintf(
            'INSERT INTO wp_posts (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'ID':
                        $stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);
                        break;
                    case 'post_author':
                        $stmt->bindValue($identifier, $this->post_author, PDO::PARAM_INT);
                        break;
                    case 'post_date':
                        $stmt->bindValue($identifier, $this->post_date ? $this->post_date->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                    case 'post_date_gmt':
                        $stmt->bindValue($identifier, $this->post_date_gmt ? $this->post_date_gmt->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                    case 'post_content':
                        $stmt->bindValue($identifier, $this->post_content, PDO::PARAM_STR);
                        break;
                    case 'post_title':
                        $stmt->bindValue($identifier, $this->post_title, PDO::PARAM_STR);
                        break;
                    case 'post_excerpt':
                        $stmt->bindValue($identifier, $this->post_excerpt, PDO::PARAM_STR);
                        break;
                    case 'post_status':
                        $stmt->bindValue($identifier, $this->post_status, PDO::PARAM_STR);
                        break;
                    case 'comment_status':
                        $stmt->bindValue($identifier, $this->comment_status, PDO::PARAM_STR);
                        break;
                    case 'ping_status':
                        $stmt->bindValue($identifier, $this->ping_status, PDO::PARAM_STR);
                        break;
                    case 'post_password':
                        $stmt->bindValue($identifier, $this->post_password, PDO::PARAM_STR);
                        break;
                    case 'post_name':
                        $stmt->bindValue($identifier, $this->post_name, PDO::PARAM_STR);
                        break;
                    case 'to_ping':
                        $stmt->bindValue($identifier, $this->to_ping, PDO::PARAM_STR);
                        break;
                    case 'pinged':
                        $stmt->bindValue($identifier, $this->pinged, PDO::PARAM_STR);
                        break;
                    case 'post_modified':
                        $stmt->bindValue($identifier, $this->post_modified ? $this->post_modified->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                    case 'post_modified_gmt':
                        $stmt->bindValue($identifier, $this->post_modified_gmt ? $this->post_modified_gmt->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                    case 'post_content_filtered':
                        $stmt->bindValue($identifier, $this->post_content_filtered, PDO::PARAM_STR);
                        break;
                    case 'post_parent':
                        $stmt->bindValue($identifier, $this->post_parent, PDO::PARAM_INT);
                        break;
                    case 'guid':
                        $stmt->bindValue($identifier, $this->guid, PDO::PARAM_STR);
                        break;
                    case 'menu_order':
                        $stmt->bindValue($identifier, $this->menu_order, PDO::PARAM_INT);
                        break;
                    case 'post_type':
                        $stmt->bindValue($identifier, $this->post_type, PDO::PARAM_STR);
                        break;
                    case 'post_mime_type':
                        $stmt->bindValue($identifier, $this->post_mime_type, PDO::PARAM_STR);
                        break;
                    case 'comment_count':
                        $stmt->bindValue($identifier, $this->comment_count, PDO::PARAM_INT);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setId($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @return Integer Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param      string $name name
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName($name, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = WpPostsTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getId();
                break;
            case 1:
                return $this->getPostAuthor();
                break;
            case 2:
                return $this->getPostDate();
                break;
            case 3:
                return $this->getPostDateGmt();
                break;
            case 4:
                return $this->getPostContent();
                break;
            case 5:
                return $this->getPostTitle();
                break;
            case 6:
                return $this->getPostExcerpt();
                break;
            case 7:
                return $this->getPostStatus();
                break;
            case 8:
                return $this->getCommentStatus();
                break;
            case 9:
                return $this->getPingStatus();
                break;
            case 10:
                return $this->getPostPassword();
                break;
            case 11:
                return $this->getPostName();
                break;
            case 12:
                return $this->getToPing();
                break;
            case 13:
                return $this->getPinged();
                break;
            case 14:
                return $this->getPostModified();
                break;
            case 15:
                return $this->getPostModifiedGmt();
                break;
            case 16:
                return $this->getPostContentFiltered();
                break;
            case 17:
                return $this->getPostParent();
                break;
            case 18:
                return $this->getGuid();
                break;
            case 19:
                return $this->getMenuOrder();
                break;
            case 20:
                return $this->getPostType();
                break;
            case 21:
                return $this->getPostMimeType();
                break;
            case 22:
                return $this->getCommentCount();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array())
    {

        if (isset($alreadyDumpedObjects['WpPosts'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['WpPosts'][$this->hashCode()] = true;
        $keys = WpPostsTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getId(),
            $keys[1] => $this->getPostAuthor(),
            $keys[2] => $this->getPostDate(),
            $keys[3] => $this->getPostDateGmt(),
            $keys[4] => $this->getPostContent(),
            $keys[5] => $this->getPostTitle(),
            $keys[6] => $this->getPostExcerpt(),
            $keys[7] => $this->getPostStatus(),
            $keys[8] => $this->getCommentStatus(),
            $keys[9] => $this->getPingStatus(),
            $keys[10] => $this->getPostPassword(),
            $keys[11] => $this->getPostName(),
            $keys[12] => $this->getToPing(),
            $keys[13] => $this->getPinged(),
            $keys[14] => $this->getPostModified(),
            $keys[15] => $this->getPostModifiedGmt(),
            $keys[16] => $this->getPostContentFiltered(),
            $keys[17] => $this->getPostParent(),
            $keys[18] => $this->getGuid(),
            $keys[19] => $this->getMenuOrder(),
            $keys[20] => $this->getPostType(),
            $keys[21] => $this->getPostMimeType(),
            $keys[22] => $this->getCommentCount(),
        );
        if ($result[$keys[2]] instanceof \DateTime) {
            $result[$keys[2]] = $result[$keys[2]]->format('c');
        }

        if ($result[$keys[3]] instanceof \DateTime) {
            $result[$keys[3]] = $result[$keys[3]]->format('c');
        }

        if ($result[$keys[14]] instanceof \DateTime) {
            $result[$keys[14]] = $result[$keys[14]]->format('c');
        }

        if ($result[$keys[15]] instanceof \DateTime) {
            $result[$keys[15]] = $result[$keys[15]]->format('c');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }


        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param  string $name
     * @param  mixed  $value field value
     * @param  string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_PHPNAME.
     * @return $this|\WpPosts
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = WpPostsTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\WpPosts
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setId($value);
                break;
            case 1:
                $this->setPostAuthor($value);
                break;
            case 2:
                $this->setPostDate($value);
                break;
            case 3:
                $this->setPostDateGmt($value);
                break;
            case 4:
                $this->setPostContent($value);
                break;
            case 5:
                $this->setPostTitle($value);
                break;
            case 6:
                $this->setPostExcerpt($value);
                break;
            case 7:
                $this->setPostStatus($value);
                break;
            case 8:
                $this->setCommentStatus($value);
                break;
            case 9:
                $this->setPingStatus($value);
                break;
            case 10:
                $this->setPostPassword($value);
                break;
            case 11:
                $this->setPostName($value);
                break;
            case 12:
                $this->setToPing($value);
                break;
            case 13:
                $this->setPinged($value);
                break;
            case 14:
                $this->setPostModified($value);
                break;
            case 15:
                $this->setPostModifiedGmt($value);
                break;
            case 16:
                $this->setPostContentFiltered($value);
                break;
            case 17:
                $this->setPostParent($value);
                break;
            case 18:
                $this->setGuid($value);
                break;
            case 19:
                $this->setMenuOrder($value);
                break;
            case 20:
                $this->setPostType($value);
                break;
            case 21:
                $this->setPostMimeType($value);
                break;
            case 22:
                $this->setCommentCount($value);
                break;
        } // switch()

        return $this;
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param      array  $arr     An array to populate the object from.
     * @param      string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = WpPostsTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setPostAuthor($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setPostDate($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setPostDateGmt($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setPostContent($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setPostTitle($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setPostExcerpt($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setPostStatus($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setCommentStatus($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setPingStatus($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setPostPassword($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setPostName($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setToPing($arr[$keys[12]]);
        }
        if (array_key_exists($keys[13], $arr)) {
            $this->setPinged($arr[$keys[13]]);
        }
        if (array_key_exists($keys[14], $arr)) {
            $this->setPostModified($arr[$keys[14]]);
        }
        if (array_key_exists($keys[15], $arr)) {
            $this->setPostModifiedGmt($arr[$keys[15]]);
        }
        if (array_key_exists($keys[16], $arr)) {
            $this->setPostContentFiltered($arr[$keys[16]]);
        }
        if (array_key_exists($keys[17], $arr)) {
            $this->setPostParent($arr[$keys[17]]);
        }
        if (array_key_exists($keys[18], $arr)) {
            $this->setGuid($arr[$keys[18]]);
        }
        if (array_key_exists($keys[19], $arr)) {
            $this->setMenuOrder($arr[$keys[19]]);
        }
        if (array_key_exists($keys[20], $arr)) {
            $this->setPostType($arr[$keys[20]]);
        }
        if (array_key_exists($keys[21], $arr)) {
            $this->setPostMimeType($arr[$keys[21]]);
        }
        if (array_key_exists($keys[22], $arr)) {
            $this->setCommentCount($arr[$keys[22]]);
        }
    }

     /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     * @param string $keyType The type of keys the array uses.
     *
     * @return $this|\WpPosts The current object, for fluid interface
     */
    public function importFrom($parser, $data, $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), $keyType);

        return $this;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(WpPostsTableMap::DATABASE_NAME);

        if ($this->isColumnModified(WpPostsTableMap::COL_ID)) {
            $criteria->add(WpPostsTableMap::COL_ID, $this->id);
        }
        if ($this->isColumnModified(WpPostsTableMap::COL_POST_AUTHOR)) {
            $criteria->add(WpPostsTableMap::COL_POST_AUTHOR, $this->post_author);
        }
        if ($this->isColumnModified(WpPostsTableMap::COL_POST_DATE)) {
            $criteria->add(WpPostsTableMap::COL_POST_DATE, $this->post_date);
        }
        if ($this->isColumnModified(WpPostsTableMap::COL_POST_DATE_GMT)) {
            $criteria->add(WpPostsTableMap::COL_POST_DATE_GMT, $this->post_date_gmt);
        }
        if ($this->isColumnModified(WpPostsTableMap::COL_POST_CONTENT)) {
            $criteria->add(WpPostsTableMap::COL_POST_CONTENT, $this->post_content);
        }
        if ($this->isColumnModified(WpPostsTableMap::COL_POST_TITLE)) {
            $criteria->add(WpPostsTableMap::COL_POST_TITLE, $this->post_title);
        }
        if ($this->isColumnModified(WpPostsTableMap::COL_POST_EXCERPT)) {
            $criteria->add(WpPostsTableMap::COL_POST_EXCERPT, $this->post_excerpt);
        }
        if ($this->isColumnModified(WpPostsTableMap::COL_POST_STATUS)) {
            $criteria->add(WpPostsTableMap::COL_POST_STATUS, $this->post_status);
        }
        if ($this->isColumnModified(WpPostsTableMap::COL_COMMENT_STATUS)) {
            $criteria->add(WpPostsTableMap::COL_COMMENT_STATUS, $this->comment_status);
        }
        if ($this->isColumnModified(WpPostsTableMap::COL_PING_STATUS)) {
            $criteria->add(WpPostsTableMap::COL_PING_STATUS, $this->ping_status);
        }
        if ($this->isColumnModified(WpPostsTableMap::COL_POST_PASSWORD)) {
            $criteria->add(WpPostsTableMap::COL_POST_PASSWORD, $this->post_password);
        }
        if ($this->isColumnModified(WpPostsTableMap::COL_POST_NAME)) {
            $criteria->add(WpPostsTableMap::COL_POST_NAME, $this->post_name);
        }
        if ($this->isColumnModified(WpPostsTableMap::COL_TO_PING)) {
            $criteria->add(WpPostsTableMap::COL_TO_PING, $this->to_ping);
        }
        if ($this->isColumnModified(WpPostsTableMap::COL_PINGED)) {
            $criteria->add(WpPostsTableMap::COL_PINGED, $this->pinged);
        }
        if ($this->isColumnModified(WpPostsTableMap::COL_POST_MODIFIED)) {
            $criteria->add(WpPostsTableMap::COL_POST_MODIFIED, $this->post_modified);
        }
        if ($this->isColumnModified(WpPostsTableMap::COL_POST_MODIFIED_GMT)) {
            $criteria->add(WpPostsTableMap::COL_POST_MODIFIED_GMT, $this->post_modified_gmt);
        }
        if ($this->isColumnModified(WpPostsTableMap::COL_POST_CONTENT_FILTERED)) {
            $criteria->add(WpPostsTableMap::COL_POST_CONTENT_FILTERED, $this->post_content_filtered);
        }
        if ($this->isColumnModified(WpPostsTableMap::COL_POST_PARENT)) {
            $criteria->add(WpPostsTableMap::COL_POST_PARENT, $this->post_parent);
        }
        if ($this->isColumnModified(WpPostsTableMap::COL_GUID)) {
            $criteria->add(WpPostsTableMap::COL_GUID, $this->guid);
        }
        if ($this->isColumnModified(WpPostsTableMap::COL_MENU_ORDER)) {
            $criteria->add(WpPostsTableMap::COL_MENU_ORDER, $this->menu_order);
        }
        if ($this->isColumnModified(WpPostsTableMap::COL_POST_TYPE)) {
            $criteria->add(WpPostsTableMap::COL_POST_TYPE, $this->post_type);
        }
        if ($this->isColumnModified(WpPostsTableMap::COL_POST_MIME_TYPE)) {
            $criteria->add(WpPostsTableMap::COL_POST_MIME_TYPE, $this->post_mime_type);
        }
        if ($this->isColumnModified(WpPostsTableMap::COL_COMMENT_COUNT)) {
            $criteria->add(WpPostsTableMap::COL_COMMENT_COUNT, $this->comment_count);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = ChildWpPostsQuery::create();
        $criteria->add(WpPostsTableMap::COL_ID, $this->id);

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int Hashcode
     */
    public function hashCode()
    {
        $validPk = null !== $this->getId();

        $validPrimaryKeyFKs = 0;
        $primaryKeyFKs = [];

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }

    /**
     * Returns the primary key for this object (row).
     * @return string
     */
    public function getPrimaryKey()
    {
        return $this->getId();
    }

    /**
     * Generic method to set the primary key (id column).
     *
     * @param       string $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \WpPosts (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setPostAuthor($this->getPostAuthor());
        $copyObj->setPostDate($this->getPostDate());
        $copyObj->setPostDateGmt($this->getPostDateGmt());
        $copyObj->setPostContent($this->getPostContent());
        $copyObj->setPostTitle($this->getPostTitle());
        $copyObj->setPostExcerpt($this->getPostExcerpt());
        $copyObj->setPostStatus($this->getPostStatus());
        $copyObj->setCommentStatus($this->getCommentStatus());
        $copyObj->setPingStatus($this->getPingStatus());
        $copyObj->setPostPassword($this->getPostPassword());
        $copyObj->setPostName($this->getPostName());
        $copyObj->setToPing($this->getToPing());
        $copyObj->setPinged($this->getPinged());
        $copyObj->setPostModified($this->getPostModified());
        $copyObj->setPostModifiedGmt($this->getPostModifiedGmt());
        $copyObj->setPostContentFiltered($this->getPostContentFiltered());
        $copyObj->setPostParent($this->getPostParent());
        $copyObj->setGuid($this->getGuid());
        $copyObj->setMenuOrder($this->getMenuOrder());
        $copyObj->setPostType($this->getPostType());
        $copyObj->setPostMimeType($this->getPostMimeType());
        $copyObj->setCommentCount($this->getCommentCount());
        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setId(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param  boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \WpPosts Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        $this->id = null;
        $this->post_author = null;
        $this->post_date = null;
        $this->post_date_gmt = null;
        $this->post_content = null;
        $this->post_title = null;
        $this->post_excerpt = null;
        $this->post_status = null;
        $this->comment_status = null;
        $this->ping_status = null;
        $this->post_password = null;
        $this->post_name = null;
        $this->to_ping = null;
        $this->pinged = null;
        $this->post_modified = null;
        $this->post_modified_gmt = null;
        $this->post_content_filtered = null;
        $this->post_parent = null;
        $this->guid = null;
        $this->menu_order = null;
        $this->post_type = null;
        $this->post_mime_type = null;
        $this->comment_count = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->applyDefaultValues();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param      boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
        } // if ($deep)

    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(WpPostsTableMap::DEFAULT_STRING_FORMAT);
    }

    /**
     * Code to be run before persisting the object
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preSave(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface $con
     */
    public function postSave(ConnectionInterface $con = null)
    {

    }

    /**
     * Code to be run before inserting to database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preInsert(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface $con
     */
    public function postInsert(ConnectionInterface $con = null)
    {

    }

    /**
     * Code to be run before updating the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preUpdate(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface $con
     */
    public function postUpdate(ConnectionInterface $con = null)
    {

    }

    /**
     * Code to be run before deleting the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preDelete(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface $con
     */
    public function postDelete(ConnectionInterface $con = null)
    {

    }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed  $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);

            return $this->importFrom($format, reset($params));
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = isset($params[0]) ? $params[0] : true;

            return $this->exportTo($format, $includeLazyLoadColumns);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
