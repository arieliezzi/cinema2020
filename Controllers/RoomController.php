<?php
	namespace Controllers;

	use Models\Room as Room;
	use DAO\RoomDAODB as RoomDAODB;
	use DAO\CinemaDAODB as CinemaDAODB;

	class RoomController {

		public function index($message = "") {
			require_once(VIEWS_PATH."adm-list-cinema.php");
		}

		public function showAddView($idCinema,$message = "") {
			require_once(VIEWS_PATH."adm-add-room.php");
		}	

		public function showModifyView($idCinema,$idRoom) {
			$this->roomDAO = new RoomDAODB();
			$room = new Room;
			$room = $this->roomDAO->getById($idRoom);
			require_once(VIEWS_PATH."adm-modify-room.php");
		}	

		public function showCinemaRooms($idCinema,$message = "") {
	        $roomList = array();
			$this->cinemaDAO = new CinemaDAODB();
			$cinema = $this->cinemaDAO->getById($idCinema);

			foreach($cinema->getRooms() as $room)
			{
              array_push($roomList,$room);
			}

			require_once(VIEWS_PATH."adm-list-room.php");
		}

		public function Add($name, $capacity, $price, $idCinema) {
			$this->roomDAO = new RoomDAODB();
			$this->cinemaDAO = new CinemaDAODB();

			$room = new Room();

			$isActive = 1;
			$room->setName($name);
			$room->setCapacity($capacity);
			$room->setPrice($price);
			$room->setIsActive($isActive);

			if (!(empty($this->roomDAO->exist($room->getName())))) {
				$this->showCinemaRooms($idCinema, "❌ ¡Ya hay una sala con ese mismo nombre en este cine, vuelva a ingresar!");
			} else {
				$this->roomDAO->add($room, $idCinema);
				$this->cinemaDAO->updateCapacity($idCinema, $capacity);
				$this->showCinemaRooms($idCinema, "✔️ ¡Sala agregada con exito!");
			}
		}

		public function Update($idCinema, $idRoom, $name, $capacity, $price) {
			$this->roomDAO = new RoomDAODB();
			$this->cinemaDAO = new CinemaDAODB();
			$auxRoom = new Room();
			$auxRoom = $this->roomDAO->getById($idRoom);

			$updatedRoom = new Room();
			$updatedRoom->setId($idRoom);
			$updatedRoom->setName($name);
			$updatedRoom->setCapacity($capacity);
			$updatedRoom->setPrice($price);
			$this->cinemaDAO->updateCapacity($idCinema, $capacity-$auxRoom->getCapacity());
			$this->roomDAO->update($updatedRoom);

			$this->showCinemaRooms($idCinema, "✔️ ¡Sala Modificada con exito!");
		}	

		public function Remove($idCinema,$idRoom) {
			$this->RoomDAO = new RoomDAODB();
			$this->CinemaDAO = new CinemaDAODB();

			$room = new Room();
			$room = $this->RoomDAO->getById($idRoom);
			$capacity = -($room->getCapacity());
			$this->CinemaDAO->updateCapacity($idCinema,$capacity);
		
			$this->RoomDAO->Remove($idRoom);
            $this->showCinemaRooms($idCinema,"✔️ ¡Sala eliminada con exito!");
        }
	}

?>