const express = require('express');
const apiRouter = express.Router();

module.exports = apiRouter;`~`

const { getAllFromDatabase, addToDatabase } = require('./db');

apiRouter.get('/minions', (req, res, next) => {
    res.send(getAllFromDatabase('minions'));
});

apiRouter.post('/minions', (req, res, next) => {
    const newMinion = addToDatabase('minions', req.body);
    res.status(201).send(newMinion);
});





