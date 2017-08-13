<?php

/**
 * Created by PhpStorm.
 * User: itcyb
 * Date: 5/24/2017
 * Time: 9:20 PM
 */
class Db_connector
{
    private $table;
    private $details;
    private $msg;
    private $error;
    private $columns;
    private $values;
    private $data=null;
    private $connection_info;
    private $insert;
    private $update;
    private $delete;
    private $select;
    private $create;
    private $query;
    private $condition;
    private $connection;
    private $extended;
    private $code;


    /**
     * Db_connector constructor.
     */
    public function __construct()
    {
        $this->table = "";
        $this->details = "";
        $this->connection = null;
        $this->msg = null;
        $this->error = false;
        $this->columns = null;
        $this->values = null;
        $this->data = null;
        $this->connection_info = null;
        $this->insert = false;
        $this->update = false;
        $this->delete = false;
        $this->select = false;
        $this->create = false;
        $this->query = null;
        $this->condition = "";
        $this->extended="";
        $this->code=null;
    }

    #Setters

    /**
     * @param string $table
     * @return Db_connector
     */
    public function setTable(string $table): Db_connector
    {
        $this->table = $table;
        return $this;
    }

    /**
     * @param array $details
     */
    public function setDetails(array $details)
    {
        $this->details = $details;
    }

    /**
     * @return null
     */
    public function getErrorCode()
    {
        return $this->code;
    }



    /**
     * @param array $data
     * @return Db_connector
     */
    public function setData(array $data): Db_connector
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @param bool $update
     * @return Db_connector
     */
    public function isUpdate(): Db_connector
    {
        $this->update = true;
        $this->select=false;
        $this->delete=false;
        $this->insert=false;
        return $this;
    }

    /**
     * @param bool $delete
     * @return Db_connector
     */
    public function isDelete(): Db_connector
    {
        $this->delete = true;
        $this->select=false;
        $this->insert=false;
        $this->update=false;
        return $this;
    }

    /**
     * @param bool $select
     * @return Db_connector
     */
    public function isSelect(): Db_connector
    {
        $this->select = true;
        $this->update=false;
        $this->delete=false;
        $this->insert=false;
        return $this;
    }

    /**
     * @param bool $insert
     * @return Db_connector
     */
    public function isInsert(): Db_connector
    {
        $this->insert = true;
        $this->select = false;
        $this->update=false;
        $this->delete=false;
        return $this;
    }

    /**
     * @param string $condition
     */
    public function setCondition(string $condition)
    {
        $this->condition = $condition;
    }


    /**
     * @return null
     */
    public function getMsg()
    {
        return $this->msg;
    }

    /**
     * @return bool
     */
    public function isError(): bool
    {
        return $this->error;
    }

    /**
     * @return null
     */
    public function getConnectionInfo()
    {
        $this->connection_info = $this->connection;
        return $this->connection_info;
    }

    /**
     * @return null
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * @param null $connection
     */
    public function setConnection($connection)
    {
        $this->connection = $connection;
    }

    public function exec()
    {
        $this->construct();
        try {
            $result = $this->connection->query($this->query);
            $this->msg = "Success";
            $this->error = false;
            if ($this->select) {
                if ($result->rowCount() > 0) {
                    if($result->rowCount()>1) {
                        return array('count' => $result->rowCount(), 'result' => $result->fetchAll(PDO::FETCH_OBJ));
                    }else{
                        return array('count' => $result->rowCount(), 'result' => $result->fetch(PDO::FETCH_OBJ));
                    }
                } else {
                    return array('count' => 0, 'result' => null);
                }
            } else {
                return array('status'=>true,'id'=>$this->connection->lastInsertId() );
            }
        } catch (PDOException $e) {
            $this->msg = $e->getMessage();
            $this->code=$e->getCode();
            $this->error = true;
            return false;
        }catch(Exception $e){
            return false;
        }
    }

    public function reset(){
        $connection=$this->connection;
        new Db_connector();
        $this->connection=$connection;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }



    private function construct()
    {
        if ($this->table !== null && $this->table !== "") {
            if (sizeof($this->data) > 0) {
                if($this->select){
                    foreach ($this->data as $column) {
                        $this->columns[] = $column;
                    }
                }else {
                    foreach ($this->data as $column => $value) {
                        $this->columns[] = $column;
                        $this->values[] = $value;
                    }
                }
                $this->set();
            } else {
                $this->error = true;
                $this->msg = "No data has been received";
                #throw error
            }
        } else {
            #throw error
            $this->msg = "No table has been declared";
            $this->error = true;
        }
    }

    private function set()
    {
        #connect to the database
        if (sizeof($this->details) > 0) {
            $host = $this->details['host'];
            $dbname = $this->details['dbname'];
            $this->msg = $dbname;
            $dbuser = $this->details['dbuser'];
            $dbpass = $this->details['dbpass'];
            $dbport = $this->details['port'];
            $report = $this->details['showerrors'];
            $options = null;
            if ($report) {
                $options = array(PDO::ATTR_EMULATE_PREPARES => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, INFO_GENERAL);
            }
            try {
                $this->connection = new PDO("mysql:host=$host;dbname=$dbname", $dbuser, $dbpass, $options);
            } catch (PDOException $e) {
                //die($e);
            }
        } else {
            #throw an error
            $this->msg = "Error";
        }
        #insert query
        if ($this->insert) {
            $fields = "";
            $count = 0;
            $vals = "";
            foreach ($this->columns as $column) {
                if ($count == 0) {
                    $fields = $column;
                    $vals = "'" . $this->values[$count] . "'";
                } else {
                    $fields .= "," . $column;
                    $vals .= ",'" . $this->values[$count] . "'";
                }
                $count++;
            }
            $query = "INSERT INTO $this->table ($fields) VALUES ($vals)";
            $this->query = $query;
        }

        #select query
        if ($this->select) {
            $fields = "";
            $count = 0;
            foreach ($this->columns as $column) {
                if ($count == 0) {
                    $fields = $this->table . "." . $column;
                } else {
                    $fields .= "," . $this->table . "." . $column;
                }
                $count++;
            }
            if($this->condition=="" || $this->condition==null){
                $query = "SELECT $fields FROM $this->table";
            }else {
                $query = "SELECT $fields FROM $this->table WHERE $this->condition";
            }
            $this->query = $query;
        }

        #update query
        if ($this->update) {
            $count = 0;
            $vals = "";
            foreach ($this->columns as $column) {
                if ($count == 0) {
                    $vals = "SET $column= '" . $this->values[$count] . "'";
                } else {
                    $vals .= ",$column= '" . $this->values[$count] . "'";
                }
                $count++;
            }
            $query = "UPDATE $this->table $vals WHERE $this->condition";

            $this->query = $query;
        }

        #delete query
        if ($this->delete) {
            $query = "DELETE FROM $this->table WHERE $this->condition";
            $this->query = $query;
        }
    }

}