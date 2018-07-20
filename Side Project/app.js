/**
 * Created By Kevin Bunn
 * - This was for an online competition during the semester, it could be coded in any language,
 *   I chose javascript to implement a what I had learned so far with classes.
 * Survive the wrath of Kutulu
 * Coded fearlessly by JohnnyYuge & nmahoude
 **/

class Entity {
    constructor (inputs, entityType, id, x, y, param0, param1, param2) {
        this.inputs = inputs;
        this.entityType = entityType;
        this.id = id;
        this.x = x;
        this.y = y;
        this.param0 = param0;
        this.param1 = param1;
        this.param2 = param2;
    }

    set distance(distance) {
        this._distance = distance;
    }

    get distance() {
        return this._distance;
    }
}

const position = {
    x: 0,
    y: 0
}

function entityTypeCount(entities, type) {
    let count = 0;
    entities.forEach(function(entity) {
        if (entity.entityType === type)
            count++;
    });
    return count;
}

function findNearestExplorer(entities) {
    let count = entityTypeCount(entities, 'EXPLORER');
    for (let i = 1; i < count; i++) {
            xd = entities[i].x - entities[0].x;
            yd = entities[i].y - entities[0].y;
            entities[i].distance = Math.sqrt(xd * xd + yd * yd);
    }
    var min = Math.min.apply(Math,entities.map(function(entity) {
        //printErr(entity.distance);
        if (entity.distance !== undefined)
            return entity.distance;
        else
            return 1000;}));

    var targetEntity;
    entities.forEach(function(entity) {
        if (entity.distance == min)
            targetEntity = entity;
    });

    return targetEntity;
}
function findNearestEnemy(entities) {
    let myExplorer = entities[0];
    entities.forEach(function(entity) {
        if (entity.entityType !== 'EXPLORER') {
            xd = entity.x - myExplorer.x;
            yd = entity.y - myExplorer.y;
            entity.distance = Math.sqrt(xd * xd + yd * yd);
        }
        else
            entity.distance = 1000;
    });
    var min =  Math.min.apply(Math,entities.map(function(entity) {
        if (entity.distance !== undefined)
            return entity.distance;
        else
            return 1000;}));

    var targetEntity;
    entities.forEach(function(entity) {
        if (entity.distance == min)
            targetEntity = entity;
    });

    return targetEntity;
}

function findHidingSpot(explorer, enemy) {
    if (explorer.x > enemy.x) {
        position.x = explorer.x + 1;
    }
    else if (explorer.x === enemy.x)
        position.x = explorer.x;
    else
        position.x = explorer.x - 1;

    if (explorer.y > enemy.y) {
        position.y = explorer.y + 1;
    }
    else if (explorer.y === enemy.y)
        position.y = explorer.y;
    else
        position.y = explorer.y - 1;
}

var width = parseInt(readline());
var height = parseInt(readline());
for (var i = 0; i < height; i++) {
    var line = readline();
}
var inputs = readline().split(' ');
var sanityLossLonely = parseInt(inputs[0]); // how much sanity you lose every turn when alone, always 3 until wood 1
var sanityLossGroup = parseInt(inputs[1]); // how much sanity you lose every turn when near another player, always 1 until wood 1
var wandererSpawnTime = parseInt(inputs[2]); // how many turns the wanderer take to spawn, always 3 until wood 1
var wandererLifeTime = parseInt(inputs[3]); // how many turns the wanderer is on map after spawning, always 40 until wood 1

// game loop
while (true) {
    var entities = [];
    var entityCount = parseInt(readline()); // the first given entity corresponds to your explorer
    for (var i = 0; i < entityCount; i++) {
        var inputs = readline().split(' ');
        var entityType = inputs[0];
        var id = parseInt(inputs[1]);
        var x = parseInt(inputs[2]);
        var y = parseInt(inputs[3]);
        var param0 = parseInt(inputs[4]);
        var param1 = parseInt(inputs[5]);
        var param2 = parseInt(inputs[6]);
        entities.push(new Entity(inputs, entityType, id, x, y, param0, param1, param2));
    }

    // Write an action using print()
    // To debug: printErr('Debug messages...');

    let nearestExlorer = findNearestExplorer(entities);
    let nearestEnemy = findNearestEnemy(entities);
    if (nearestEnemy !== undefined && nearestExlorer !== undefined) {
        let hidingSpot = findHidingSpot(nearestExlorer, nearestEnemy);
        print(`MOVE ${position.x} ${position.y}`);
    }
    else {
        print('WAIT');
    }

    //print(`MOVE ${nearestEnemy.x} ${nearestEnemy.y}`);
    //print('WAIT'); // MOVE <x> <y> | WAIT
}