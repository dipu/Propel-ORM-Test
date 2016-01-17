<?php

namespace Base;

use \WpLinksQuery as ChildWpLinksQuery;
use \DateTime;
use \Exception;
use \PDO;
use Map\WpLinksTableMap;
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
 * Base class that represents a row from the 'wp_links' table.
 *
 *
 *
* @package    propel.generator..Base
*/
abstract class WpLinks implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\WpLinksTableMap';


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
     * The value for the link_id field.
     *
     * @var        string
     */
    protected $link_id;

    /**
     * The value for the link_url field.
     *
     * Note: this column has a database default value of: ''
     * @var        string
     */
    protected $link_url;

    /**
     * The value for the link_name field.
     *
     * Note: this column has a database default value of: ''
     * @var        string
     */
    protected $link_name;

    /**
     * The value for the link_image field.
     *
     * Note: this column has a database default value of: ''
     * @var        string
     */
    protected $link_image;

    /**
     * The value for the link_target field.
     *
     * Note: this column has a database default value of: ''
     * @var        string
     */
    protected $link_target;

    /**
     * The value for the link_description field.
     *
     * Note: this column has a database default value of: ''
     * @var        string
     */
    protected $link_description;

    /**
     * The value for the link_visible field.
     *
     * Note: this column has a database default value of: 'Y'
     * @var        string
     */
    protected $link_visible;

    /**
     * The value for the link_owner field.
     *
     * Note: this column has a database default value of: '1'
     * @var        string
     */
    protected $link_owner;

    /**
     * The value for the link_rating field.
     *
     * Note: this column has a database default value of: 0
     * @var        int
     */
    protected $link_rating;

    /**
     * The value for the link_updated field.
     *
     * Note: this column has a database default value of: NULL
     * @var        \DateTime
     */
    protected $link_updated;

    /**
     * The value for the link_rel field.
     *
     * Note: this column has a database default value of: ''
     * @var        string
     */
    protected $link_rel;

    /**
     * The value for the link_notes field.
     *
     * @var        string
     */
    protected $link_notes;

    /**
     * The value for the link_rss field.
     *
     * Note: this column has a database default value of: ''
     * @var        string
     */
    protected $link_rss;

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
        $this->link_url = '';
        $this->link_name = '';
        $this->link_image = '';
        $this->link_target = '';
        $this->link_description = '';
        $this->link_visible = 'Y';
        $this->link_owner = '1';
        $this->link_rating = 0;
        $this->link_updated = PropelDateTime::newInstance(NULL, null, 'DateTime');
        $this->link_rel = '';
        $this->link_rss = '';
    }

    /**
     * Initializes internal state of Base\WpLinks object.
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
     * Compares this with another <code>WpLinks</code> instance.  If
     * <code>obj</code> is an instance of <code>WpLinks</code>, delegates to
     * <code>equals(WpLinks)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|WpLinks The current object, for fluid interface
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
     * Get the [link_id] column value.
     *
     * @return string
     */
    public function getLinkId()
    {
        return $this->link_id;
    }

    /**
     * Get the [link_url] column value.
     *
     * @return string
     */
    public function getLinkUrl()
    {
        return $this->link_url;
    }

    /**
     * Get the [link_name] column value.
     *
     * @return string
     */
    public function getLinkName()
    {
        return $this->link_name;
    }

    /**
     * Get the [link_image] column value.
     *
     * @return string
     */
    public function getLinkImage()
    {
        return $this->link_image;
    }

    /**
     * Get the [link_target] column value.
     *
     * @return string
     */
    public function getLinkTarget()
    {
        return $this->link_target;
    }

    /**
     * Get the [link_description] column value.
     *
     * @return string
     */
    public function getLinkDescription()
    {
        return $this->link_description;
    }

    /**
     * Get the [link_visible] column value.
     *
     * @return string
     */
    public function getLinkVisible()
    {
        return $this->link_visible;
    }

    /**
     * Get the [link_owner] column value.
     *
     * @return string
     */
    public function getLinkOwner()
    {
        return $this->link_owner;
    }

    /**
     * Get the [link_rating] column value.
     *
     * @return int
     */
    public function getLinkRating()
    {
        return $this->link_rating;
    }

    /**
     * Get the [optionally formatted] temporal [link_updated] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00 00:00:00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getLinkUpdated($format = NULL)
    {
        if ($format === null) {
            return $this->link_updated;
        } else {
            return $this->link_updated instanceof \DateTime ? $this->link_updated->format($format) : null;
        }
    }

    /**
     * Get the [link_rel] column value.
     *
     * @return string
     */
    public function getLinkRel()
    {
        return $this->link_rel;
    }

    /**
     * Get the [link_notes] column value.
     *
     * @return string
     */
    public function getLinkNotes()
    {
        return $this->link_notes;
    }

    /**
     * Get the [link_rss] column value.
     *
     * @return string
     */
    public function getLinkRss()
    {
        return $this->link_rss;
    }

    /**
     * Set the value of [link_id] column.
     *
     * @param string $v new value
     * @return $this|\WpLinks The current object (for fluent API support)
     */
    public function setLinkId($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->link_id !== $v) {
            $this->link_id = $v;
            $this->modifiedColumns[WpLinksTableMap::COL_LINK_ID] = true;
        }

        return $this;
    } // setLinkId()

    /**
     * Set the value of [link_url] column.
     *
     * @param string $v new value
     * @return $this|\WpLinks The current object (for fluent API support)
     */
    public function setLinkUrl($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->link_url !== $v) {
            $this->link_url = $v;
            $this->modifiedColumns[WpLinksTableMap::COL_LINK_URL] = true;
        }

        return $this;
    } // setLinkUrl()

    /**
     * Set the value of [link_name] column.
     *
     * @param string $v new value
     * @return $this|\WpLinks The current object (for fluent API support)
     */
    public function setLinkName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->link_name !== $v) {
            $this->link_name = $v;
            $this->modifiedColumns[WpLinksTableMap::COL_LINK_NAME] = true;
        }

        return $this;
    } // setLinkName()

    /**
     * Set the value of [link_image] column.
     *
     * @param string $v new value
     * @return $this|\WpLinks The current object (for fluent API support)
     */
    public function setLinkImage($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->link_image !== $v) {
            $this->link_image = $v;
            $this->modifiedColumns[WpLinksTableMap::COL_LINK_IMAGE] = true;
        }

        return $this;
    } // setLinkImage()

    /**
     * Set the value of [link_target] column.
     *
     * @param string $v new value
     * @return $this|\WpLinks The current object (for fluent API support)
     */
    public function setLinkTarget($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->link_target !== $v) {
            $this->link_target = $v;
            $this->modifiedColumns[WpLinksTableMap::COL_LINK_TARGET] = true;
        }

        return $this;
    } // setLinkTarget()

    /**
     * Set the value of [link_description] column.
     *
     * @param string $v new value
     * @return $this|\WpLinks The current object (for fluent API support)
     */
    public function setLinkDescription($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->link_description !== $v) {
            $this->link_description = $v;
            $this->modifiedColumns[WpLinksTableMap::COL_LINK_DESCRIPTION] = true;
        }

        return $this;
    } // setLinkDescription()

    /**
     * Set the value of [link_visible] column.
     *
     * @param string $v new value
     * @return $this|\WpLinks The current object (for fluent API support)
     */
    public function setLinkVisible($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->link_visible !== $v) {
            $this->link_visible = $v;
            $this->modifiedColumns[WpLinksTableMap::COL_LINK_VISIBLE] = true;
        }

        return $this;
    } // setLinkVisible()

    /**
     * Set the value of [link_owner] column.
     *
     * @param string $v new value
     * @return $this|\WpLinks The current object (for fluent API support)
     */
    public function setLinkOwner($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->link_owner !== $v) {
            $this->link_owner = $v;
            $this->modifiedColumns[WpLinksTableMap::COL_LINK_OWNER] = true;
        }

        return $this;
    } // setLinkOwner()

    /**
     * Set the value of [link_rating] column.
     *
     * @param int $v new value
     * @return $this|\WpLinks The current object (for fluent API support)
     */
    public function setLinkRating($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->link_rating !== $v) {
            $this->link_rating = $v;
            $this->modifiedColumns[WpLinksTableMap::COL_LINK_RATING] = true;
        }

        return $this;
    } // setLinkRating()

    /**
     * Sets the value of [link_updated] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\WpLinks The current object (for fluent API support)
     */
    public function setLinkUpdated($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->link_updated !== null || $dt !== null) {
            if ( ($dt != $this->link_updated) // normalized values don't match
                || ($dt->format('Y-m-d H:i:s') === NULL) // or the entered value matches the default
                 ) {
                $this->link_updated = $dt === null ? null : clone $dt;
                $this->modifiedColumns[WpLinksTableMap::COL_LINK_UPDATED] = true;
            }
        } // if either are not null

        return $this;
    } // setLinkUpdated()

    /**
     * Set the value of [link_rel] column.
     *
     * @param string $v new value
     * @return $this|\WpLinks The current object (for fluent API support)
     */
    public function setLinkRel($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->link_rel !== $v) {
            $this->link_rel = $v;
            $this->modifiedColumns[WpLinksTableMap::COL_LINK_REL] = true;
        }

        return $this;
    } // setLinkRel()

    /**
     * Set the value of [link_notes] column.
     *
     * @param string $v new value
     * @return $this|\WpLinks The current object (for fluent API support)
     */
    public function setLinkNotes($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->link_notes !== $v) {
            $this->link_notes = $v;
            $this->modifiedColumns[WpLinksTableMap::COL_LINK_NOTES] = true;
        }

        return $this;
    } // setLinkNotes()

    /**
     * Set the value of [link_rss] column.
     *
     * @param string $v new value
     * @return $this|\WpLinks The current object (for fluent API support)
     */
    public function setLinkRss($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->link_rss !== $v) {
            $this->link_rss = $v;
            $this->modifiedColumns[WpLinksTableMap::COL_LINK_RSS] = true;
        }

        return $this;
    } // setLinkRss()

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
            if ($this->link_url !== '') {
                return false;
            }

            if ($this->link_name !== '') {
                return false;
            }

            if ($this->link_image !== '') {
                return false;
            }

            if ($this->link_target !== '') {
                return false;
            }

            if ($this->link_description !== '') {
                return false;
            }

            if ($this->link_visible !== 'Y') {
                return false;
            }

            if ($this->link_owner !== '1') {
                return false;
            }

            if ($this->link_rating !== 0) {
                return false;
            }

            if ($this->link_updated && $this->link_updated->format('Y-m-d H:i:s') !== NULL) {
                return false;
            }

            if ($this->link_rel !== '') {
                return false;
            }

            if ($this->link_rss !== '') {
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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : WpLinksTableMap::translateFieldName('LinkId', TableMap::TYPE_PHPNAME, $indexType)];
            $this->link_id = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : WpLinksTableMap::translateFieldName('LinkUrl', TableMap::TYPE_PHPNAME, $indexType)];
            $this->link_url = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : WpLinksTableMap::translateFieldName('LinkName', TableMap::TYPE_PHPNAME, $indexType)];
            $this->link_name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : WpLinksTableMap::translateFieldName('LinkImage', TableMap::TYPE_PHPNAME, $indexType)];
            $this->link_image = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : WpLinksTableMap::translateFieldName('LinkTarget', TableMap::TYPE_PHPNAME, $indexType)];
            $this->link_target = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : WpLinksTableMap::translateFieldName('LinkDescription', TableMap::TYPE_PHPNAME, $indexType)];
            $this->link_description = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : WpLinksTableMap::translateFieldName('LinkVisible', TableMap::TYPE_PHPNAME, $indexType)];
            $this->link_visible = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : WpLinksTableMap::translateFieldName('LinkOwner', TableMap::TYPE_PHPNAME, $indexType)];
            $this->link_owner = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : WpLinksTableMap::translateFieldName('LinkRating', TableMap::TYPE_PHPNAME, $indexType)];
            $this->link_rating = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : WpLinksTableMap::translateFieldName('LinkUpdated', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00 00:00:00') {
                $col = null;
            }
            $this->link_updated = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : WpLinksTableMap::translateFieldName('LinkRel', TableMap::TYPE_PHPNAME, $indexType)];
            $this->link_rel = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 11 + $startcol : WpLinksTableMap::translateFieldName('LinkNotes', TableMap::TYPE_PHPNAME, $indexType)];
            $this->link_notes = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 12 + $startcol : WpLinksTableMap::translateFieldName('LinkRss', TableMap::TYPE_PHPNAME, $indexType)];
            $this->link_rss = (null !== $col) ? (string) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 13; // 13 = WpLinksTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\WpLinks'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(WpLinksTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildWpLinksQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
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
     * @see WpLinks::setDeleted()
     * @see WpLinks::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(WpLinksTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildWpLinksQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(WpLinksTableMap::DATABASE_NAME);
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
                WpLinksTableMap::addInstanceToPool($this);
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

        $this->modifiedColumns[WpLinksTableMap::COL_LINK_ID] = true;
        if (null !== $this->link_id) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . WpLinksTableMap::COL_LINK_ID . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(WpLinksTableMap::COL_LINK_ID)) {
            $modifiedColumns[':p' . $index++]  = 'link_id';
        }
        if ($this->isColumnModified(WpLinksTableMap::COL_LINK_URL)) {
            $modifiedColumns[':p' . $index++]  = 'link_url';
        }
        if ($this->isColumnModified(WpLinksTableMap::COL_LINK_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'link_name';
        }
        if ($this->isColumnModified(WpLinksTableMap::COL_LINK_IMAGE)) {
            $modifiedColumns[':p' . $index++]  = 'link_image';
        }
        if ($this->isColumnModified(WpLinksTableMap::COL_LINK_TARGET)) {
            $modifiedColumns[':p' . $index++]  = 'link_target';
        }
        if ($this->isColumnModified(WpLinksTableMap::COL_LINK_DESCRIPTION)) {
            $modifiedColumns[':p' . $index++]  = 'link_description';
        }
        if ($this->isColumnModified(WpLinksTableMap::COL_LINK_VISIBLE)) {
            $modifiedColumns[':p' . $index++]  = 'link_visible';
        }
        if ($this->isColumnModified(WpLinksTableMap::COL_LINK_OWNER)) {
            $modifiedColumns[':p' . $index++]  = 'link_owner';
        }
        if ($this->isColumnModified(WpLinksTableMap::COL_LINK_RATING)) {
            $modifiedColumns[':p' . $index++]  = 'link_rating';
        }
        if ($this->isColumnModified(WpLinksTableMap::COL_LINK_UPDATED)) {
            $modifiedColumns[':p' . $index++]  = 'link_updated';
        }
        if ($this->isColumnModified(WpLinksTableMap::COL_LINK_REL)) {
            $modifiedColumns[':p' . $index++]  = 'link_rel';
        }
        if ($this->isColumnModified(WpLinksTableMap::COL_LINK_NOTES)) {
            $modifiedColumns[':p' . $index++]  = 'link_notes';
        }
        if ($this->isColumnModified(WpLinksTableMap::COL_LINK_RSS)) {
            $modifiedColumns[':p' . $index++]  = 'link_rss';
        }

        $sql = sprintf(
            'INSERT INTO wp_links (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'link_id':
                        $stmt->bindValue($identifier, $this->link_id, PDO::PARAM_INT);
                        break;
                    case 'link_url':
                        $stmt->bindValue($identifier, $this->link_url, PDO::PARAM_STR);
                        break;
                    case 'link_name':
                        $stmt->bindValue($identifier, $this->link_name, PDO::PARAM_STR);
                        break;
                    case 'link_image':
                        $stmt->bindValue($identifier, $this->link_image, PDO::PARAM_STR);
                        break;
                    case 'link_target':
                        $stmt->bindValue($identifier, $this->link_target, PDO::PARAM_STR);
                        break;
                    case 'link_description':
                        $stmt->bindValue($identifier, $this->link_description, PDO::PARAM_STR);
                        break;
                    case 'link_visible':
                        $stmt->bindValue($identifier, $this->link_visible, PDO::PARAM_STR);
                        break;
                    case 'link_owner':
                        $stmt->bindValue($identifier, $this->link_owner, PDO::PARAM_INT);
                        break;
                    case 'link_rating':
                        $stmt->bindValue($identifier, $this->link_rating, PDO::PARAM_INT);
                        break;
                    case 'link_updated':
                        $stmt->bindValue($identifier, $this->link_updated ? $this->link_updated->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                    case 'link_rel':
                        $stmt->bindValue($identifier, $this->link_rel, PDO::PARAM_STR);
                        break;
                    case 'link_notes':
                        $stmt->bindValue($identifier, $this->link_notes, PDO::PARAM_STR);
                        break;
                    case 'link_rss':
                        $stmt->bindValue($identifier, $this->link_rss, PDO::PARAM_STR);
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
        $this->setLinkId($pk);

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
        $pos = WpLinksTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getLinkId();
                break;
            case 1:
                return $this->getLinkUrl();
                break;
            case 2:
                return $this->getLinkName();
                break;
            case 3:
                return $this->getLinkImage();
                break;
            case 4:
                return $this->getLinkTarget();
                break;
            case 5:
                return $this->getLinkDescription();
                break;
            case 6:
                return $this->getLinkVisible();
                break;
            case 7:
                return $this->getLinkOwner();
                break;
            case 8:
                return $this->getLinkRating();
                break;
            case 9:
                return $this->getLinkUpdated();
                break;
            case 10:
                return $this->getLinkRel();
                break;
            case 11:
                return $this->getLinkNotes();
                break;
            case 12:
                return $this->getLinkRss();
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

        if (isset($alreadyDumpedObjects['WpLinks'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['WpLinks'][$this->hashCode()] = true;
        $keys = WpLinksTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getLinkId(),
            $keys[1] => $this->getLinkUrl(),
            $keys[2] => $this->getLinkName(),
            $keys[3] => $this->getLinkImage(),
            $keys[4] => $this->getLinkTarget(),
            $keys[5] => $this->getLinkDescription(),
            $keys[6] => $this->getLinkVisible(),
            $keys[7] => $this->getLinkOwner(),
            $keys[8] => $this->getLinkRating(),
            $keys[9] => $this->getLinkUpdated(),
            $keys[10] => $this->getLinkRel(),
            $keys[11] => $this->getLinkNotes(),
            $keys[12] => $this->getLinkRss(),
        );
        if ($result[$keys[9]] instanceof \DateTime) {
            $result[$keys[9]] = $result[$keys[9]]->format('c');
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
     * @return $this|\WpLinks
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = WpLinksTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\WpLinks
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setLinkId($value);
                break;
            case 1:
                $this->setLinkUrl($value);
                break;
            case 2:
                $this->setLinkName($value);
                break;
            case 3:
                $this->setLinkImage($value);
                break;
            case 4:
                $this->setLinkTarget($value);
                break;
            case 5:
                $this->setLinkDescription($value);
                break;
            case 6:
                $this->setLinkVisible($value);
                break;
            case 7:
                $this->setLinkOwner($value);
                break;
            case 8:
                $this->setLinkRating($value);
                break;
            case 9:
                $this->setLinkUpdated($value);
                break;
            case 10:
                $this->setLinkRel($value);
                break;
            case 11:
                $this->setLinkNotes($value);
                break;
            case 12:
                $this->setLinkRss($value);
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
        $keys = WpLinksTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setLinkId($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setLinkUrl($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setLinkName($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setLinkImage($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setLinkTarget($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setLinkDescription($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setLinkVisible($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setLinkOwner($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setLinkRating($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setLinkUpdated($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setLinkRel($arr[$keys[10]]);
        }
        if (array_key_exists($keys[11], $arr)) {
            $this->setLinkNotes($arr[$keys[11]]);
        }
        if (array_key_exists($keys[12], $arr)) {
            $this->setLinkRss($arr[$keys[12]]);
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
     * @return $this|\WpLinks The current object, for fluid interface
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
        $criteria = new Criteria(WpLinksTableMap::DATABASE_NAME);

        if ($this->isColumnModified(WpLinksTableMap::COL_LINK_ID)) {
            $criteria->add(WpLinksTableMap::COL_LINK_ID, $this->link_id);
        }
        if ($this->isColumnModified(WpLinksTableMap::COL_LINK_URL)) {
            $criteria->add(WpLinksTableMap::COL_LINK_URL, $this->link_url);
        }
        if ($this->isColumnModified(WpLinksTableMap::COL_LINK_NAME)) {
            $criteria->add(WpLinksTableMap::COL_LINK_NAME, $this->link_name);
        }
        if ($this->isColumnModified(WpLinksTableMap::COL_LINK_IMAGE)) {
            $criteria->add(WpLinksTableMap::COL_LINK_IMAGE, $this->link_image);
        }
        if ($this->isColumnModified(WpLinksTableMap::COL_LINK_TARGET)) {
            $criteria->add(WpLinksTableMap::COL_LINK_TARGET, $this->link_target);
        }
        if ($this->isColumnModified(WpLinksTableMap::COL_LINK_DESCRIPTION)) {
            $criteria->add(WpLinksTableMap::COL_LINK_DESCRIPTION, $this->link_description);
        }
        if ($this->isColumnModified(WpLinksTableMap::COL_LINK_VISIBLE)) {
            $criteria->add(WpLinksTableMap::COL_LINK_VISIBLE, $this->link_visible);
        }
        if ($this->isColumnModified(WpLinksTableMap::COL_LINK_OWNER)) {
            $criteria->add(WpLinksTableMap::COL_LINK_OWNER, $this->link_owner);
        }
        if ($this->isColumnModified(WpLinksTableMap::COL_LINK_RATING)) {
            $criteria->add(WpLinksTableMap::COL_LINK_RATING, $this->link_rating);
        }
        if ($this->isColumnModified(WpLinksTableMap::COL_LINK_UPDATED)) {
            $criteria->add(WpLinksTableMap::COL_LINK_UPDATED, $this->link_updated);
        }
        if ($this->isColumnModified(WpLinksTableMap::COL_LINK_REL)) {
            $criteria->add(WpLinksTableMap::COL_LINK_REL, $this->link_rel);
        }
        if ($this->isColumnModified(WpLinksTableMap::COL_LINK_NOTES)) {
            $criteria->add(WpLinksTableMap::COL_LINK_NOTES, $this->link_notes);
        }
        if ($this->isColumnModified(WpLinksTableMap::COL_LINK_RSS)) {
            $criteria->add(WpLinksTableMap::COL_LINK_RSS, $this->link_rss);
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
        $criteria = ChildWpLinksQuery::create();
        $criteria->add(WpLinksTableMap::COL_LINK_ID, $this->link_id);

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
        $validPk = null !== $this->getLinkId();

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
        return $this->getLinkId();
    }

    /**
     * Generic method to set the primary key (link_id column).
     *
     * @param       string $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setLinkId($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getLinkId();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \WpLinks (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setLinkUrl($this->getLinkUrl());
        $copyObj->setLinkName($this->getLinkName());
        $copyObj->setLinkImage($this->getLinkImage());
        $copyObj->setLinkTarget($this->getLinkTarget());
        $copyObj->setLinkDescription($this->getLinkDescription());
        $copyObj->setLinkVisible($this->getLinkVisible());
        $copyObj->setLinkOwner($this->getLinkOwner());
        $copyObj->setLinkRating($this->getLinkRating());
        $copyObj->setLinkUpdated($this->getLinkUpdated());
        $copyObj->setLinkRel($this->getLinkRel());
        $copyObj->setLinkNotes($this->getLinkNotes());
        $copyObj->setLinkRss($this->getLinkRss());
        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setLinkId(NULL); // this is a auto-increment column, so set to default value
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
     * @return \WpLinks Clone of current object.
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
        $this->link_id = null;
        $this->link_url = null;
        $this->link_name = null;
        $this->link_image = null;
        $this->link_target = null;
        $this->link_description = null;
        $this->link_visible = null;
        $this->link_owner = null;
        $this->link_rating = null;
        $this->link_updated = null;
        $this->link_rel = null;
        $this->link_notes = null;
        $this->link_rss = null;
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
        return (string) $this->exportTo(WpLinksTableMap::DEFAULT_STRING_FORMAT);
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
