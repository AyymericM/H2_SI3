const express = require('express')
const path = require('path')

module.exports = class Serve {
    constructor() {
        this.app = express()
        this.router = express.Router()

        this.registerRoute()
    }

    registerRoute() {
        this.router.use(express.static(
            path.resolve(__dirname, '..', '..', 'build'),
            { maxAge: '30d'}
        ));
        this.router.use('^/*', (req, res) => {
            res.sendFile(path.resolve(__dirname, '..', '..', 'build') + '/index.html')
        });
        this.app.use(this.router)
    }

    start() {
        this.app.listen(3000, () => {
            console.log('App listening on port 3000!');
        });
    }
}