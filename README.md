# Core10

## Coding Challenge
Your challenge, should you choose to accept it, is to build a server that queries the Star Wars API for information on how to beat the Galactic Empire.

### Requirements
1. [x] Build a REST API to connect to the [Star Wars API](https://swapi.dev/documentation#intro)
2. [x] Include a readme on how to interact with the API
3. [x] Include tests

### Endpoints to build
1. [x] Return a list of the Starships related to Luke Skywalker
2. [x] Return the classification of all species in the 1st episode
3. [x] Return the total population of all planets in the Galaxy

### Submission
Upload your application to a public repository and share the link with us

## Getting Started
### Requirements
- Docker must be installed and running in the background
- Postman is required for interacting with the API

### Startup
- Run `sh init.sh`
    - I'm unsure why, but the backend consistently does not seem to run after newing it up for the first time, but consistently runs after second time.
- Import the `Core10.postman_environment.json` and `Core10.postman_collection.json` files into Postman to get access to the collection
- Instructions were assumed and a simple UI can be interacted with on `localhost:3000`
    - Requested are hardcoded due to the specifics of the challenge, but there are obvious improvements to be made here to remove the hardcoded strings
