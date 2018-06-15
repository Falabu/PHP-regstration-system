<?php
/**
 * Class for manage the users codes
 *
 *
 *
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
     * Check if the code is just have letters and numbers
     *
     * @return bool
     */
    private function codeChecker()
    {
        if (preg_match("/^[a-zA-Z0-9]*$/", $this->code)) {
            $this->code = strtoupper($this->code);
            return true;
        } else {
            return false;
        }
    }

    /**
     * Check if the code is have enough lenght
     *
     * @return bool
     */
    private function lenghtCheck()
    {
        if (mb_strlen($this->code) != 24) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Return an array that conatins the users codes that uploaded to database
     *
     * @return array
     */
    public function getCodes()
    {
        return $this->formatCodes($this->codeDb->get($this->uId));
    }

    /**
     * Formats the code to more readable every 4 letters it is inserts a "-"
     *
     * @param $codeArray
     * @return array
     */
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

    /**
     * Uploads the code to the database after checking
     *
     * @return bool
     *
     */

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
