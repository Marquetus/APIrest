<?php

class usersModel extends Mysql //Heredity
{
    private $strId;
    private $intIdLocation;
    private $intIdDepartment;
    private $intIdRol;
    private $intIdUserCategory;
    private $strName;
    private $strSurname;
    private $strEmail;
    private $strPass;
    private $strDescription;
    private $strImage;
    private $fltHoursMonth;
    private $intStatus;

    /*Construct methop inherits from mysql library*/
    public function __construct()
    {
        parent::__construct();
    }

    /* Functions */
    public function selectAll()
    {
        //Pull out
        $sql = "SELECT * FROM users WHERE status != 0";
        $request = $this->select_all($sql);
        return $request;
    }

    public function selectOne()
    {
        //Search for
        $sql = "SELECT u.*, l.city city, d.name department_name, r.name rol_name, c.name category_name FROM users u 
        INNER JOIN locations l ON l.id = u.id_location
        INNER JOIN departments d ON d.id = u.id_department
        INNER JOIN roles r ON r.id = u.id_rol
        INNER JOIN users_categories c ON c.id = u.id_user_category
        WHERE u.id = '{$this->getStrId()}'";
        $request = $this->select($sql);
        return $request;
    }

    public function insertOne()
    {
        //New
        $sql = "SELECT * FROM users WHERE email = '{$this->getStrEmail()}'";
        $request = $this->select_all($sql);

        if (empty($request)) {
            $uniqid = "US" . uniqid() . rand(0, 9); //Id generator
            $query_insert = "INSERT INTO users
            (id, id_location, id_department, id_rol, id_user_category, name, surname, email, pass, description, image, hours_month, status, created_at, updated_at) 
            VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,NOW(),NULL)";
            $arrData = array(
                $uniqid, $this->getIntIdLocation(), $this->getIntIdDepartment(), $this->getIntIdRol(), $this->getIntIdUserCategory(),
                $this->getStrName(), $this->getStrSurname(), $this->getStrEmail(), $this->getStrPass(), $this->getStrDescription(),
                $this->getStrImage(), $this->getFltHoursMonth(), $this->getIntStatus()
            );
            $request_insert = $this->insert($query_insert, $arrData);
            if ($request_insert[0]) {
                $return = array("okey", $uniqid);
            } else {
                $return = array("fail");
            }
        } else {
            $return = array("exist");
        }
        return $return;
    }

    public function updateOne()
    {
        //Update
        $sql = "SELECT * FROM users WHERE email = '{$this->getStrEmail()}' AND id != '{$this->getStrId()}'";
        $request = $this->select_all($sql);

        if (empty($request)) {
            $query_update = "UPDATE users SET
            id_location=?, id_department=?, id_rol=?, id_user_category=?, name=?, surname=?, email=?,
            pass=?, description=?, image=?, hours_month=?, status=?, updated_at=NOW()
            WHERE id = '{$this->getStrId()}'";
            $arrData = array(
                $this->getIntIdLocation(), $this->getIntIdDepartment(), $this->getIntIdRol(), $this->getIntIdUserCategory(),
                $this->getStrName(), $this->getStrSurname(), $this->getStrEmail(), $this->getStrPass(), $this->getStrDescription(),
                $this->getStrImage(), $this->getFltHoursMonth(), $this->getIntStatus()
            );
            $request_update = $this->update($query_update, $arrData);
            if ($request_update) {
                $return = "okey";
            } else {
                $return = "fail";
            }
        } else {
            $return = "exist";
        }
        return $return;
    }

    public function changeStatus()
    {
        //Change Status
        $query_update = "UPDATE users SET status = ?, updated_at = NOW() WHERE id = {$this->getStrId()}";
        $arrData = array($this->getIntStatus());
        $request_update = $this->update($query_update, $arrData);
        $return = $request_update;
        return $return;
    }

    public function deleteOne()
    {
        //Delete
        $sql = "DELETE FROM users WHERE id = {$this->getStrId()} LIMIT 1 ";
        $request = $this->delete($sql);
        return $request;
    }

    /* Getters and Setters */
    public function getStrId()
    {
        return $this->strId;
    }
    public function setStrId($strId)
    {
        $this->strId = $strId;

        return $this;
    }

    public function getIntIdLocation()
    {
        return $this->intIdLocation;
    }
    public function setIntIdLocation($intIdLocation)
    {
        $this->intIdLocation = $intIdLocation;

        return $this;
    }

    public function getIntIdDepartment()
    {
        return $this->intIdDepartment;
    }
    public function setIntIdDepartment($intIdDepartment)
    {
        $this->intIdDepartment = $intIdDepartment;

        return $this;
    }

    public function getIntIdRol()
    {
        return $this->intIdRol;
    }
    public function setIntIdRol($intIdRol)
    {
        $this->intIdRol = $intIdRol;

        return $this;
    }

    public function getIntIdUserCategory()
    {
        return $this->intIdUserCategory;
    }
    public function setIntIdUserCategory($intIdUserCategory)
    {
        $this->intIdUserCategory = $intIdUserCategory;

        return $this;
    }

    public function getStrName()
    {
        return $this->strName;
    }
    public function setStrName($strName)
    {
        $this->strName = $strName;

        return $this;
    }

    public function getStrSurname()
    {
        return $this->strSurname;
    }
    public function setStrSurname($strSurname)
    {
        $this->strSurname = $strSurname;

        return $this;
    }

    public function getStrEmail()
    {
        return $this->strEmail;
    }
    public function setStrEmail($strEmail)
    {
        $this->strEmail = $strEmail;

        return $this;
    }

    public function getStrPass()
    {
        return $this->strPass;
    }
    public function setStrPass($strPass)
    {
        $this->strPass = $strPass;

        return $this;
    }

    public function getStrDescription()
    {
        return $this->strDescription;
    }
    public function setStrDescription($strDescription)
    {
        $this->strDescription = $strDescription;

        return $this;
    }

    public function getStrImage()
    {
        return $this->strImage;
    }
    public function setStrImage($strImage)
    {
        $this->strImage = $strImage;

        return $this;
    }

    public function getFltHoursMonth()
    {
        return $this->fltHoursMonth;
    }
    public function setFltHoursMonth($fltHoursMonth)
    {
        $this->fltHoursMonth = $fltHoursMonth;

        return $this;
    }

    public function getIntStatus()
    {
        return $this->intStatus;
    }
    public function setIntStatus($intStatus)
    {
        $this->intStatus = $intStatus;

        return $this;
    }
}
