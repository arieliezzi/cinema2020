<?php

namespace DAO;
use Models\Cinema as Cinema;

class CinemaDAO implements ICinemaDAO
{
    private $cinemaList = array();

    public function Add(Cinema $cinema)
    {
        $this->RetrieveData();

        $cinema->setId($this->GetNextId());

        array_push($this->cinemaList, $cinema);

        $this->SaveData();
    }

    public function GetAll()
    {
        $this->RetrieveData();

        return $this->cinemaList;
    }

    public function SaveData()
    {
        $arrayToEncode = array();

             foreach($this->cinemaList as $cinema)
            {
                $valuesArray["id"] = $cinema->getId();
                $valuesArray["imageUrl"] = $cinema->getImageUrl();
                $valuesArray["name"] = $cinema->getName();
                $valuesArray["capacity"] = $cinema->getCapacity();
                $valuesArray["address"] = $cinema->getAddress();
                $valuesArray["price"] = $cinema->getPrice();
    
                array_push($arrayToEncode, $valuesArray);
            }
    
            $jsonContent = json_encode($arrayToEncode, JSON_PRETTY_PRINT);
            file_put_contents("Data/cinemas.json", $jsonContent);
        }

    public function Remove($id)
        {            
            $this->RetrieveData();
            
            $this->cinemaList = array_filter($this->cinemaList, function($cinema) use($id){                
                return $cinema->getId() != $id;
            });
            
            $this->SaveData();
    }

    public function GetById($id)
    {            
        $this->RetrieveData();

        foreach($this->cinemaList as $cinema)
        {
            if ($cinema->getId()==$id)
            return $cinema;
        }
    }

    public function update($updatedCinema)
    {            
        $this->RetrieveData();

        foreach($this->cinemaList as $cinema)
        {
            if ($cinema->getId()==$updatedCinema->getId())
            {
            $cinema->setName($updatedCinema->getName());
            $cinema->setCapacity($updatedCinema->getCapacity());
            $cinema->setPrice($updatedCinema->getPrice());
            $cinema->setAddress($updatedCinema->getAddress());
            $cinema->setImageUrl($updatedCinema->getImageUrl());
            }

        }
        $this->saveData();
    }

    private function RetrieveData()
    {
        $this->cinemaList = array();

        if(file_exists("Data/cinemas.json"))
        {
            $jsonContent = file_get_contents("Data/cinemas.json");

            $arrayToDecode = ($jsonContent) ? json_decode($jsonContent, true) : array();

            foreach($arrayToDecode as $valuesArray)
            {
                $cinema = new Cinema();
                $cinema->setId($valuesArray["id"]);
                $cinema->setImageUrl($valuesArray["imageUrl"]);
                $cinema->setName($valuesArray["name"]);
                $cinema->setCapacity($valuesArray["capacity"]);
                $cinema->setAddress($valuesArray["address"]);
                $cinema->setPrice($valuesArray["price"]);

                array_push($this->cinemaList, $cinema);
            }
        }
    }

    private function GetNextId()
    {
        $id = 0;

        foreach($this->cinemaList as $cinema)
        {
            $id = ($cinema->getId() > $id) ? $cinema->getId() : $id;
        }

        return $id + 1;
    }
}

?>