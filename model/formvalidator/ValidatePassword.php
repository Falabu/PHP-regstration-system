<?php
/**
 * Created by PhpStorm.
 * User: DaweTheDrummer
 * Date: 2018. 06. 21.
 * Time: 16:38
 */

namespace model\formvalidator;


use Utils\errorLogger;

class ValidatePassword implements ValidatorInterface
{
    private $minCapitalLetter;
    private $minNumber;
    private $minSpecialChar;
    private $minLenght;

    private $letters = 'aábcdeéfghiíjklmnoóöőpqrstuúüűvwxyz';
    private $specialChars = '+-!?.,:;(){}[]=*/%\'\"\\\$';
    private $numbers = '0123456789';
    private $capLetters;

    public function __construct($lenght, $minNum, $minCapLetter, $minSpecialChar)
    {
        $this->minLenght = $lenght;
        $this->minSpecialChar = $minSpecialChar;
        $this->minCapitalLetter = $minCapLetter;
        $this->minNumber = $minNum;
        $this->capLetters = strtoupper($this->letters);
    }

    public function validate($data)
    {
        $smallLetter = 0;
        $capLetter = 0;
        $specialChar = 0;
        $number = 0;

        if (isset($data) && $data != "") {
            if (mb_strlen($data) >= $this->minLenght) {
                for ($i = 0; $i < mb_strlen($data); $i++) {
                    if (mb_strpos($this->letters, $data[$i]) !== false) {
                        $smallLetter++;
                    } elseif (mb_strpos($this->capLetters, $data[$i]) !== false) {
                        $capLetter++;
                    } elseif (mb_strpos($this->numbers, $data[$i]) !== false) {
                        $number++;
                    } elseif (mb_strpos($this->specialChars, $data[$i]) !== false) {
                        $specialChar++;
                    }

                }
                if($this->minNumber <= $number && $this->minCapitalLetter <= $capLetter && $this->minSpecialChar <= $specialChar){
                    return true;
                }

                 errorLogger::writeUserMessages("Nincs elég kis/nagy/speciális karakter");
                return false;
            }
            errorLogger::writeUserMessages("Nem elég hosszú a jelszó");
            return false;
        }

        return false;
    }
}