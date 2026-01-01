<?php

namespace Database\Seeders;

use App\Models\Movie;
use Illuminate\Database\Seeder;

class MovieSeeder extends Seeder
{
    public function run(): void
    {
        $movies = [
            [
                'title' => 'Inception',
                'director' => 'Christopher Nolan',
                'release_year' => 2010,
                'description' => 'A thief who steals corporate secrets through dream-sharing technology is given the inverse task of planting an idea into the mind of a C.E.O.',
                'genre' => 'Sci-Fi',
                'rating' => 8.8,
                'duration' => '2h 28min',
                'poster_image' => 'images/movies/inception.jpg',
                'trailer_url' => 'https://www.youtube.com/watch?v=YoHD9XEInc0'
            ],
            [
                'title' => 'The Shawshank Redemption',
                'director' => 'Frank Darabont',
                'release_year' => 1994,
                'description' => 'Two imprisoned men bond over a number of years, finding solace and eventual redemption through acts of common decency.',
                'genre' => 'Drama',
                'rating' => 9.3,
                'duration' => '2h 22min',
                'poster_image' => 'images/movies/shawshank.jpg',
                'trailer_url' => 'https://www.youtube.com/watch?v=6hB3S9bIaco'
            ],
            [
                'title' => 'The Dark Knight',
                'director' => 'Christopher Nolan',
                'release_year' => 2008,
                'description' => 'When the menace known as the Joker wreaks havoc and chaos on the people of Gotham, Batman must accept one of the greatest psychological and physical tests of his ability to fight injustice.',
                'genre' => 'Action',
                'rating' => 9.0,
                'duration' => '2h 32min',
                'poster_image' => 'images/movies/the-dark-knight.jpg',
                'trailer_url' => 'https://www.youtube.com/watch?v=EXeTwQWrcwY'
            ],
            [
                'title' => 'Pulp Fiction',
                'director' => 'Quentin Tarantino',
                'release_year' => 1994,
                'description' => 'The lives of two mob hitmen, a boxer, a gangster and his wife intertwine in four tales of violence and redemption.',
                'genre' => 'Crime',
                'rating' => 8.9,
                'duration' => '2h 34min',
                'poster_image' => 'images/movies/pulp-fiction.jpg',
                'trailer_url' => 'https://www.youtube.com/watch?v=s7EdQ4FqbhY'
            ],
            [
                'title' => 'Parasite',
                'director' => 'Bong Joon Ho',
                'release_year' => 2019,
                'description' => 'Greed and class discrimination threaten the newly formed symbiotic relationship between the wealthy Park family and the destitute Kim clan.',
                'genre' => 'Thriller',
                'rating' => 8.6,
                'duration' => '2h 12min',
                'poster_image' => 'images/movies/parasite.jpg',
                'trailer_url' => 'https://www.youtube.com/watch?v=5xH0HfJHsaY'
            ]
        ];

        foreach ($movies as $movie) {
            Movie::create($movie);
        }
    }
}