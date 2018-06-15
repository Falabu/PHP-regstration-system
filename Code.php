<?php
/**
 * Created by PhpStorm.
 * User: DaweTheDrummer
 * Date: 2018. 06. 13.
 * Time: 14:57
 */

class Code
{
    private $code;
    private $uId;
    private $codeDb;

    public function __construct($uId, $code = NULL)
    {
        if (isset($uId) && isset($code)) {
            $this->code = $code;
            $this->uId = $uId;
        } else {
            $this->uId = $uId;
        }

        $this->codeDb = new CodeDataManager();
    }

    /**
     * @param mixed $uId
     */
    public function setUId($uId)
    {
        $this->uId = $uId;
    }


    private function codeChecker()
    {
        if (preg_match("/^[a-zA-Z0-9]*$/", $this->code)) {
            $this->code = strtoupper($this->code);
            return true;
        } else {
            return false;
        }
    }

    private function lenghtCheck()
    {
        if (mb_strlen($this->code) != 24) {
            return false;
        } else {
            return true;
        }
    }

    public function getCodes()
    {
        return $this->formatCodes($this->codeDb->get($this->uId));
    }

    private function formatCodes($codeArray)
    {
        $tmpCodeArray = array();

        for ($j = 0; $j < count($codeArray); $j++) {
            $tmpCodeArray[$j] = "";
            for ($i = 0; $i < strlen($codeArray[$j]); $i++) {
                if ($i % 4 == 0 && $i != 0) {
                    $tmpCodeArray[$j] .= "-";
                }
                $tmpCodeArray[$j] .= $codeArray[$j][$i];
            }
        }

        return $tmpCodeArray;
    }


    public function uploadCode()
    {
        if ($this->lenghtCheck()) {
            if ($this->codeChecker()) {
                $this->codeDb->upload($this->uId, $this->code);
                errorLogger::writeUserMessages("A kód sikeresen feltöltve");
                return true;
            } else {
                errorLogger::writeUserMessages("A kód csak betűt és számot tartalmazhat és ékezetes karaktert nem");
                return false;
            }
        } else {
            errorLogger::writeUserMessages("A kódnak 24 jegyűnek kell lennie");
            return false;
        }
    }
}
