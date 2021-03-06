const express = require("express");
const apiRouter = require("./api/api");

const bodyParser = require("body-parser");
const morgan = require("morgan");
const cors = require("cors");
const errorHandler = require("errorhandler");

const app = express();

const PORT = process.env.PORT || 4000;

app.use(bodyParser.json());
app.use(morgan("dev"));
app.use(cors());

app.use("/api", apiRouter);

app.use(errorHandler());

app.listen(PORT, () => {
  console.log(`Server is listening on PORT: ${PORT}`);
});

module.exports = app;
