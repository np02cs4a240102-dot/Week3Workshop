

// API Endpoint
const API_URL = 'http://localhost:3000/movies';

// DOM Elements
const movieListDiv = document.getElementById('movie-list');
const searchInput = document.getElementById('search-input');
const form = document.getElementById('add-movie-form');

let allMovies = []; // Stores full movie list


//  Render Movies

function renderMovies(movies) {
  movieListDiv.innerHTML = '';

  if (movies.length === 0) {
    movieListDiv.innerHTML = `<p>No movies found matching your criteria.</p>`;
    return;
  }

  movies.forEach(movie => {
    const movieElement = document.createElement('div');
    movieElement.classList.add('movie-item');

    movieElement.innerHTML = `
      <p><strong>${movie.title}</strong> (${movie.year}) - ${movie.genre}</p>
      <button class="edit-btn">Edit</button>
      <button class="delete-btn">Delete</button>
    `;

    // Add event listeners (no inline JS!)
    movieElement.querySelector('.edit-btn').addEventListener('click', () => {
      editMoviePrompt(movie);
    });

    movieElement.querySelector('.delete-btn').addEventListener('click', () => {
      deleteMovie(movie.id);
    });

    movieListDiv.appendChild(movieElement);
  });
}


//  Fetch All Movies (GET)

function fetchMovies() {
  fetch(API_URL)
    .then(response => response.json())
    .then(data => {
      allMovies = data;
      renderMovies(allMovies);
    })
    .catch(error => console.error('Error fetching movies:', error));
}

fetchMovies(); // Initial load


//  Search Movies (CLIENT-SIDE)

searchInput.addEventListener('input', () => {
  const term = searchInput.value.toLowerCase();

  const filtered = allMovies.filter(movie =>
    movie.title.toLowerCase().includes(term) ||
    movie.genre.toLowerCase().includes(term)
  );

  renderMovies(filtered);
});


//  Add Movie (POST)

form.addEventListener('submit', function (event) {
  event.preventDefault();

  const newMovie = {
    title: document.getElementById('title').value,
    genre: document.getElementById('genre').value,
    year: parseInt(document.getElementById('year').value)
  };

  fetch(API_URL, {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify(newMovie)
  })
    .then(response => {
      if (!response.ok) throw new Error('Failed to add movie');
      return response.json();
    })
    .then(() => {
      form.reset();
      fetchMovies();
    })
    .catch(error => console.error('Error adding movie:', error));
});


//  Edit Movie (Prompt)

function editMoviePrompt(movie) {
  const newTitle = prompt("Enter new title:", movie.title);
  const newYear = prompt("Enter new year:", movie.year);
  const newGenre = prompt("Enter new genre:", movie.genre);

  if (!newTitle || !newYear || !newGenre) return;

  const updatedMovie = {
    id: movie.id,
    title: newTitle,
    year: parseInt(newYear),
    genre: newGenre
  };

  updateMovie(movie.id, updatedMovie);
}


//  Update Movie (PUT)

function updateMovie(id, updatedMovie) {
  fetch(`${API_URL}/${id}`, {
    method: 'PUT',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify(updatedMovie)
  })
    .then(response => {
      if (!response.ok) throw new Error('Failed to update movie');
      return response.json();
    })
    .then(() => fetchMovies())
    .catch(error => console.error('Error updating movie:', error));
}


//  Delete Movie (DELETE)

function deleteMovie(id) {
  fetch(`${API_URL}/${id}`, {
    method: 'DELETE'
  })
    .then(response => {
      if (!response.ok) throw new Error('Failed to delete movie');
      fetchMovies();
    })
    .catch(error => console.error('Error deleting movie:', error));
}
