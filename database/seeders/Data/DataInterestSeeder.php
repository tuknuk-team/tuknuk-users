<?php

namespace Database\Seeders\Data;

use App\Models\Data\DataInterest;
use Illuminate\Database\Seeder;

class DataInterestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $movie = DataInterest::create([
            'name' => 'Filme',
            'image' => 'https://intellectus.nyc3.digitaloceanspaces.com/interests/filmes.png'
        ]);

        $series = DataInterest::create([
            'name' => 'Série',
            'image' => 'https://intellectus.nyc3.digitaloceanspaces.com/interests/series.png'
        ]);

        $book = DataInterest::create([
            'name' => 'Livro',
            'image' => 'https://intellectus.nyc3.digitaloceanspaces.com/interests/livros.png'
        ]);

        $music = DataInterest::create([
            'name' => 'Música',
            'image' => 'https://intellectus.nyc3.digitaloceanspaces.com/interests/musicas.png'
        ]);

        $article = DataInterest::create([
            'name' => 'Artigo',
            'image' => 'https://intellectus.nyc3.digitaloceanspaces.com/interests/arquivo.png'
        ]);

        DataInterest::create([
            'name' => 'Aventura',
            'child_id' => $movie->id
        ]);

        DataInterest::create([
            'name' => 'Ação',
            'child_id' => $movie->id
        ]);

        DataInterest::create([
            'name' => 'Comédia',
            'child_id' => $movie->id
        ]);

        DataInterest::create([
            'name' => 'Drama',
            'child_id' => $movie->id
        ]);

        DataInterest::create([
            'name' => 'Fantasia',
            'child_id' => $movie->id
        ]);

        DataInterest::create([
            'name' => 'Terror',
            'child_id' => $movie->id
        ]);

        DataInterest::create([
            'name' => 'Musical',
            'child_id' => $movie->id
        ]);

        DataInterest::create([
            'name' => 'Romance',
            'child_id' => $movie->id
        ]);

        DataInterest::create([
            'name' => 'Ficção',
            'child_id' => $movie->id
        ]);

        DataInterest::create([
            'name' => 'Infantil',
            'child_id' => $movie->id
        ]);

        DataInterest::create([
            'name' => 'Ação',
            'child_id' => $series->id
        ]);

        DataInterest::create([
            'name' => 'Anime',
            'child_id' => $series->id
        ]);

        DataInterest::create([
            'name' => 'Asiáticos',
            'child_id' => $series->id
        ]);

        DataInterest::create([
            'name' => 'Brasileiros',
            'child_id' => $series->id
        ]);

        DataInterest::create([
            'name' => 'Britânicos',
            'child_id' => $series->id
        ]);

        DataInterest::create([
            'name' => 'Ciência e natureza',
            'child_id' => $series->id
        ]);

        DataInterest::create([
            'name' => 'Comédia',
            'child_id' => $series->id
        ]);

        DataInterest::create([
            'name' => 'Drama',
            'child_id' => $series->id
        ]);

        DataInterest::create([
            'name' => 'Esportes',
            'child_id' => $series->id
        ]);

        DataInterest::create([
            'name' => 'EUA',
            'child_id' => $series->id
        ]);

        DataInterest::create([
            'name' => 'Ficção científica e fantasia',
            'child_id' => $series->id
        ]);

        DataInterest::create([
            'name' => 'Mistério',
            'child_id' => $series->id
        ]);

        DataInterest::create([
            'name' => 'Novelas',
            'child_id' => $series->id
        ]);

        DataInterest::create([
            'name' => 'Infantil',
            'child_id' => $series->id
        ]);

        DataInterest::create([
            'name' => 'Policiais',
            'child_id' => $series->id
        ]);

        DataInterest::create([
            'name' => 'Reality e talk shows',
            'child_id' => $series->id
        ]);

        DataInterest::create([
            'name' => 'Romance',
            'child_id' => $series->id
        ]);

        DataInterest::create([
            'name' => 'Séries documentais',
            'child_id' => $series->id
        ]);

        DataInterest::create([
            'name' => 'Teen',
            'child_id' => $series->id
        ]);

        DataInterest::create([
            'name' => 'Terror',
            'child_id' => $series->id
        ]);

        DataInterest::create([
            'name' => 'Autoajuda',
            'child_id' => $book->id
        ]);

        DataInterest::create([
            'name' => 'Autoajuda',
            'child_id' => $book->id
        ]);

        DataInterest::create([
            'name' => 'História',
            'child_id' => $book->id
        ]);

        DataInterest::create([
            'name' => 'Crônicas, Humor e Entretenimento',
            'child_id' => $book->id
        ]);

        DataInterest::create([
            'name' => 'Gastronomia e Culinária',
            'child_id' => $book->id
        ]);

        DataInterest::create([
            'name' => 'Educação, Referência e Didáticos',
            'child_id' => $book->id
        ]);

        DataInterest::create([
            'name' => 'Medicina',
            'child_id' => $book->id
        ]);

        DataInterest::create([
            'name' => 'HQs, Mangás e Graphic Novels',
            'child_id' => $book->id
        ]);

        DataInterest::create([
            'name' => 'Computação, Informática e Mídias Digitais',
            'child_id' => $book->id
        ]);

        DataInterest::create([
            'name' => 'Fantasia, Horror e Ficção Científica',
            'child_id' => $book->id
        ]);

        DataInterest::create([
            'name' => 'Romance',
            'child_id' => $book->id
        ]);

        DataInterest::create([
            'name' => 'Esportes e Lazer',
            'child_id' => $book->id
        ]);

        DataInterest::create([
            'name' => 'Administração, Negócios e Economia',
            'child_id' => $book->id
        ]);

        DataInterest::create([
            'name' => 'Arte, Cinema e Fotografia',
            'child_id' => $book->id
        ]);

        DataInterest::create([
            'name' => 'Religião e Espiritualidade',
            'child_id' => $book->id
        ]);

        DataInterest::create([
            'name' => 'Livros Para Jovens E Adolescentes',
            'child_id' => $book->id
        ]);

        DataInterest::create([
            'name' => 'Saúde e Família',
            'child_id' => $book->id
        ]);

        DataInterest::create([
            'name' => 'Literatura E Ficção',
            'child_id' => $book->id
        ]);

        DataInterest::create([
            'name' => 'Livros Infantis',
            'child_id' => $book->id
        ]);

        DataInterest::create([
            'name' => 'Erótico',
            'child_id' => $book->id
        ]);

        DataInterest::create([
            'name' => 'Ficção Infantil E Juvenil',
            'child_id' => $book->id
        ]);

        DataInterest::create([
            'name' => 'Escolas E Ensino',
            'child_id' => $book->id
        ]);

        DataInterest::create([
            'name' => 'Política E Ciências Sociais',
            'child_id' => $book->id
        ]);

        DataInterest::create([
            'name' => 'Livros De Ciências, Matemática E Tecnologia',
            'child_id' => $book->id
        ]);

        DataInterest::create([
            'name' => 'Biografias E Casos Verdadeiros',
            'child_id' => $book->id
        ]);

        DataInterest::create([
            'name' => 'Crime, Suspense E Mistério',
            'child_id' => $book->id
        ]);

        DataInterest::create([
            'name' => 'Direito',
            'child_id' => $book->id
        ]);

        DataInterest::create([
            'name' => 'Música',
            'child_id' => $book->id
        ]);

        DataInterest::create([
            'name' => 'Direito Profissional E Técnico',
            'child_id' => $book->id
        ]);

        DataInterest::create([
            'name' => 'Inglês E Outras Línguas',
            'child_id' => $book->id
        ]);

        DataInterest::create([
            'name' => 'Artesanato, Casa E Estilo De Vida',
            'child_id' => $book->id
        ]);

        DataInterest::create([
            'name' => 'Humor E Entretenimento',
            'child_id' => $book->id
        ]);

        DataInterest::create([
            'name' => 'Engenharia E Transporte Livros',
            'child_id' => $book->id
        ]);

        DataInterest::create([
            'name' => 'Lgbtq+',
            'child_id' => $book->id
        ]);

        DataInterest::create([
            'name' => 'Medicina Profissional E Técnico',
            'child_id' => $book->id
        ]);

        DataInterest::create([
            'name' => 'Viagens',
            'child_id' => $book->id
        ]);
    }
}
