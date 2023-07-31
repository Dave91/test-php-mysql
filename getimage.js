import api_key from "./api";

const url = "https://api.thecatapi.com/v1/images/search?";

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
      document.getElementById("imgCont").appendChild(image);
    });
  })
  .catch(function (error) {
    console.log(error);
  });
