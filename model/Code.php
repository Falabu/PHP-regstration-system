<?php
/**
 * Ide beírok valamit elehetasdadsad
 *
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
        return $this->codeDb->get($this->uId);
    }

    public function uploadCodes()
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
        }else{
            errorLogger::writeUserMessages("A kódnak 24 jegyűnek kell lennie");
            return false;
        }
    }
}