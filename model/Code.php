<?php
/**
 * Class for manage the users codes
 *
 * Copyright (C) 2018 by Kurucz Dávid
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @author Kurucz Dávid
 */

class Code
{
    private $code;
    private $uId;
    private $codeDb;

    public function __construct(CodeDataManagerInterface $dataMG, $uId, $code = NULL)
    {
        $this->code = $code;
        $this->uId = $uId;
        $this->codeDb = $dataMG;
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
                $tmpCodeArray[$j] .= strtoupper($codeArray[$j][$i]);
            }
        }

        return $tmpCodeArray;
    }

    /**
     * Check if the code is just have letters and numbers
     *
     * @return bool
     */
    private function codeChecker()
    {
        if (!preg_match("/^[a-zA-Z0-9]*$/", $this->code)) {
            return false;
        }
        return true;
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
        }

        return true;
    }
}
