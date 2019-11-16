const express = require('express');
const apiRouter = express.Router();

module.exports = apiRouter;

const { getAllFromDatabase, addToDatabase, getFromDatabaseById, updateInstanceInDatabase } = require('./db');

// Minion Routes
apiRouter.get('/minions', (req, res, next) => {
    res.send(getAllFromDatabase('minions'));
});

apiRouter.post('/minions', (req, res, next) => {
    const newMinion = addToDatabase('minions', req.body);
    res.status(201).send(newMinion);
});

apiRouter.get('/minions/:minionId', (req, res, next) => {
    const minion = getFromDatabaseById('minions', req.params.minionId)
    if (minion) {
        res.send(minion);
    } else {
        res.status(404).send();
    }
});

apiRouter.put('/minions/:minionId', (req, res, next) => {
    const minion = getFromDatabaseById('minions', req.params.minionId)
    if (minion) {
        let updatedMinion = updateInstanceInDatabase('minions', req.body);
        res.send(updatedMinion);
    } else {
        res.status(404).send();
    }
});

// Ideas Route







