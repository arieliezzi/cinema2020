<?php

    namespace DAO;

    use DAO\IGenreDAO as IGenreDAO;
    use DAO\Connection as Connection;
    use DAO\QueryType as QueryType;
    use Models\Genre as Genre;

    class GenreDAODB implements IGenreDAO 
    {
        private $connection;

        public function Add(genre $genre)
        {
                try {   
                $query = "INSERT INTO genres (id_genre, name) VALUES (:id_genre, :name)";

                $parameters["id_genre"] = $genre->getId();
                $parameters["name"] =  $genre->getName();

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters, QueryType::Query);
            } catch(Exception $exception) {
                echo "No se pudo agregar el genero";
            }
        }

        public function getGenre(int $id)
        {
            try {
                $query = "SELECT * FROM genres WHERE id_genre = :id_genre";

                $parameters["id_genre"] = $id;

                $this->connection = Connection::GetInstance();

                $result = $this->connection->Execute($query, $parameters, QueryType::Query);

                foreach($result as $row) 
                {
                    $genre = new Genre();
                    $genre->setId($row["id_genre"]);
                    $genre->setName($row["name"]);
                }

                return $genre;
            } catch(Exception $exception) {
                echo "No se pudo agregar el genero";
            }
        }

        public function GetAll()
        {
            try {
                $genreList = array();

                $query = "SELECT * FROM genres ORDER BY name ASC";

                $this->connection = Connection::GetInstance();

                $result = $this->connection->Execute($query, array(), QueryType::Query);

                foreach($result as $row) {
                    $genre = new Genre();
                    $genre->setId($row["id_genre"]);
                    $genre->setName($row["name"]);
                    array_push($genreList, $genre);
                }

                return $genreList;
            } catch(Exception $exception) {
                echo "No se pudo obtener los generos";
            }
        }

        public function GetAllFilterByShows()
        {
            try {
                $genreList = array();

                $query = "SELECT genres.id_genre,name FROM genres INNER JOIN movieGenre ON genres.id_genre=movieGenre.id_genre INNER JOIN movies ON movies.id_movie=movieGenre.id_movie INNER JOIN shows ON shows.id_movie = movies.id_movie WHERE shows.isActive = 1 AND CURDATE() between shows.startDate AND shows.endDate GROUP BY genres.name ORDER BY genres.name ASC";

                $this->connection = Connection::GetInstance();

                $result = $this->connection->Execute($query, array(), QueryType::Query);

                foreach($result as $row) {
                    $genre = new Genre();
                    $genre->setId($row["id_genre"]);
                    $genre->setName($row["name"]);
                    array_push($genreList, $genre);
                }

                return $genreList;
            } catch(Exception $exception) {
                echo "No se pudo obtener los generos";
            }
        }

        public function Remove($id)
        {         
            try {   
                $query = "DELETE FROM genres WHERE id = :id";

                $parameters["id"] =  $id;

                $this->connection = Connection::GetInstance();

                $this->connection->ExecuteNonQuery($query, $parameters, QueryType::Query);
            } catch(Exception $exception) {
                echo "No se pudo eliminar genero";
            }
        }

    }
?>