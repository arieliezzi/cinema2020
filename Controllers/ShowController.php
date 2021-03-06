<?php
	namespace Controllers;

	use Models\Show as Show;
	use DAO\CinemaDAODB as CinemaDAODB;
	use DAO\RoomDAODB as RoomDAODB;
	use DAO\MovieDAODB as MovieDAODB;
	use DAO\ShowDAODB as ShowDAODB;
	use DAO\GenreDAODB as GenreDAODB;

	class ShowController {

		public function index($message = "") {
			require_once(VIEWS_PATH."adm-list-cinema.php");
		}

		public function showListView($message = "") {
			$this->showDAO = new ShowDAODB();		
			$showList = $this->ConstructShow($this->showDAO->getAll());

			require_once(VIEWS_PATH."adm-list-show.php");
		}	

		public function showUserListView($message = "") {
			$this->showDAO = new ShowDAODB();		
			$this->genreDAO = new GenreDAODB();
            $genreList = $this->genreDAO->GetAllFilterByShows();
			$showList = $this->ConstructShow($this->showDAO->GetAllFilterByCurrentDay());
			
			require_once(VIEWS_PATH."usr-list-show.php");
		}	

		public function showUserListViewByNewest($message = "") {
			$this->showDAO = new ShowDAODB();	
			$this->genreDAO = new GenreDAODB();
            $genreList = $this->genreDAO->GetAllFilterByShows();	
			$showList = $this->ConstructShow($this->showDAO->GetAllOrderByNewest());
			
			require_once(VIEWS_PATH."usr-list-show.php");
		}	

		public function showUserListViewByOldest($message = "") {
			$this->showDAO = new ShowDAODB();		
			$this->genreDAO = new GenreDAODB();
            $genreList = $this->genreDAO->GetAllFilterByShows();
			$showList = $this->ConstructShow($this->showDAO->GetAllOrderByOldest());
			
			require_once(VIEWS_PATH."usr-list-show.php");
		}	

		public function showUserListByGenre($message = "",$idGenre) {
			$this->showDAO = new ShowDAODB();		
			$this->genreDAO = new GenreDAODB();
            $genreList = $this->genreDAO->GetAllFilterByShows();
			$showList = $this->ConstructShow($this->showDAO->GetAllByIdGenre($idGenre));
			
			require_once(VIEWS_PATH."usr-list-show.php");
		}	

		public function showAddView($message = "") {
			$this->cinemaDAO = new CinemaDAODB();
			$cinemaList = $this->cinemaDAO->getAll();

			require_once(VIEWS_PATH."adm-add-show-cinema.php");
		}	

		public function showAddViewRoomSelect($idCinema,$message="") {
			$this->roomDAO = new RoomDAODB();
			$roomList = $this->roomDAO->getAll($idCinema);

			require_once(VIEWS_PATH."adm-add-show-room.php");
		}	

		public function showAddViewMovieSelect($idCinema,$idRoom,$message="") {
			$this->movieDAO = new MovieDAODB();
			$movieList = $this->movieDAO->getAll();

			require_once(VIEWS_PATH."adm-add-show-movie.php");
		}	

		public function showAddViewScheduleSelect($idCinema,$idRoom,$idMovie,$message="") {
			require_once(VIEWS_PATH."adm-add-show-schedule.php");
		}	

		public function showModifyView($idShow,$message="") {
			$this->showDAO = new ShowDAODB();		
			$show =$this->showDAO->getById($idShow);
			$show = $this->ConstructShow($show);

			require_once(VIEWS_PATH."adm-modify-show.php");
		}	

		public function Add($idCinema,$idRoom,$idMovie,$startDate,$endDate,$time,$duration) {
			if (!($startDate>=date("Y-m-d")))
				$this->showAddViewScheduleSelect($idCinema,$idRoom,$idMovie,"❌ ¡La fecha debe ser superior o igual a la actual: ".date("Y-m-d")."!");
				else
					if(!($endDate>=$startDate))
						$this->showAddViewScheduleSelect($idCinema,$idRoom,$idMovie,"❌ ¡La fecha de inicio debe ser inferior a la final!");
						else
							{
								$this->cinemaDAO = new CinemaDAODB();
								$this->roomDAO = new RoomDAODB();
								$this->movieDAO = new MovieDAODB();
								$this->showDAO = new ShowDAODB();
								
								if(!(empty($showList = $this->showDAO->validateUniqueShow($startDate,$idMovie))))
								{
								  $this->showAddViewScheduleSelect($idCinema,$idRoom,$idMovie,"❌ ¡Ya existe una funcion con esa pelicula en la misma fecha!");
								}
								 else
								   {
									   if(!(empty($showListT= $this->showDAO->getShowsByTime($time,date("H:i" ,strtotime($time." + ".($duration+15)."minutes")),$startDate,$endDate))))
									   {
										$this->showAddViewScheduleSelect($idCinema,$idRoom,$idMovie,"❌ ¡Ya existe una funcion a esa hora en la misma sala en esas fechas!");
									   }
									   else
									   {
											$show = new Show();
											$show->setCinema($this->cinemaDAO->getById($idCinema));
											$show->setRoom($this->roomDAO->getById($idRoom));
											$show->setMovie($this->movieDAO->getMovie($idMovie));
											$show->setStartDate($startDate);
											$show->setEndDate($endDate);
											$show->setStartTime($time);
											$show->setEndTime(date("H:i" ,strtotime($time." + ".($duration+15)."minutes")));
											$show->setDuration($duration);
											$show->setIsActive(1);
								
											$this->showDAO->add($show);
											$this->showListView("✔️ ¡Funcion agregada con exito!");
									   }
								   }
							}
		}	

		public function Update($idShow,$startDate,$endDate,$time,$duration) 
		{
			if (!($startDate>=date("Y-m-d")))
			$this->showModifyView($idShow,"❌ ¡La fecha debe ser superior o igual a la actual: ".date("Y-m-d")."!");
			else
				if(!($endDate>=$startDate))
					$this->showModifyView($idShow,"❌ ¡La fecha de inicio debe ser inferior a la final!");
					else
						{
							$this->showDAO = new ShowDAODB();
							$updatedShow = new Show();
							$updatedShow->setId($idShow);
							$updatedShow->setStartDate($startDate);
							$updatedShow->setEndDate($endDate);
							$updatedShow->setStartTime($time);
							$updatedShow->setEndTime(date("H:i" ,strtotime($time." + ".($duration+15)."minutes")));
							$updatedShow->setDuration($duration);

							$this->showDAO->update($updatedShow);
							
							$this->showListView("✔️ ¡Funcion Modificada con exito!");
						}	
		}

		public function Remove($idShow) {

			$this->showDAO=new ShowDAODB();
			$this->showDAO->Remove($idShow);

            $this->showListView("✔️ ¡Funcion eliminada con exito!");
		}
		
		public function ConstructShow($showList) {
	
			$this->cinemaDAO = new CinemaDAODB();
			$this->roomDAO = new RoomDAODB();
			$this->movieDAO = new MovieDAODB();

			if (is_array($showList))
			{
				foreach ($showList as $show)
				{
					$show->setCinema($this->cinemaDAO->getById($show->getCinema()));
					$show->setRoom($this->roomDAO->getById($show->getRoom()));
					$show->setMovie($this->movieDAO->getMovie($show->getMovie()));
				}
			} else {
				$showList->setCinema($this->cinemaDAO->getById($showList->getCinema()));
				$showList->setRoom($this->roomDAO->getById($showList->getRoom()));
				$showList->setMovie($this->movieDAO->getMovie($showList->getMovie()));
			}
	
            return $showList;
		}

	}

?>