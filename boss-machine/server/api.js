const express = require('express');
const apiRouter = express.Router();

module.exports = apiRouter;

const { getAllFromDatabase, addToDatabase, getFromDatabaseById, updateInstanceInDatabase, deleteFromDatabasebyId } = require('./db');

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

apiRouter.delete('/minions/:minionId', (req, res, next) => {
    const minion = getFromDatabaseById('minions', req.params.minionId)
    if (minion) {
        let deletedMinion = deleteFromDatabasebyId('minions', req.params.minionId);
        if (deletedMinion) {
            res.status(204).send();
        } else {
            res.status(404).send();
        }
    } else {
        res.status(404).send();
    }
});

// Ideas Route
apiRouter.get('/ideas', (req, res, next) => {
    res.send(getAllFromDatabase('ideas'));
});

apiRouter.post('/ideas', (req, res, next) => {
    const newIdea = addToDatabase('ideas', req.body);
    res.status(201).send(newIdea);
});

apiRouter.get('/ideas/:ideaId', (req, res, next) => {
    const idea = getFromDatabaseById('ideas', req.params.ideaId)
    if (idea) {
        res.send(idea);
    } else {
        res.status(404).send();
    }
});

apiRouter.put('/ideas/:ideaId', (req, res, next) => {
    const idea = getFromDatabaseById('ideas', req.params.ideaId)
    if (idea) {
        let updatedIdea = updateInstanceInDatabase('ideas', req.body);
        res.send(updatedIdea);
    } else {
        res.status(404).send();
    }
});

apiRouter.delete('/ideas/:ideaId', (req, res, next) => {
    const idea = getFromDatabaseById('ideas', req.params.ideaId)
    if (idea) {
        let deletedIdea = deleteFromDatabasebyId('ideas', req.params.ideaId);
        if (deletedIdea) {
            res.status(204).send();
        } else {
            res.status(404).send();
        }
    } else {
        res.status(404).send();
    }
});






