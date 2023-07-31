const url = "https://api.thecatapi.com/v1/images/search?";
const api_key =
  "live_Pa7h5cSqQiNHaUM1CUwqQ5cvAWz6vUTq5nlLpTfhifBa0VcRWJp0j8PSE1hJWdKc";

fetch(url, {
  headers: {
    "x-api-key": api_key,
  },
})
  .then((response) => {
    return response.json();
  })
  .then((data) => {
    let imagesData = data;
    imagesData.map(function (imageData) {
      let image = document.createElement("img");
      image.src = `${imageData.url}`;
      //let imageCont = document.createElement("div");
      document.getElementById("imageCont").appendChild(image);
    });
  })
  .catch(function (error) {
    console.log(error);
  });
