const io = require('socket.io')(process.env.SOCKET_PORT || 1337)
const Serve = require('./utils/Serve')
const serve = new Serve()
serve.start()

io.on('connection', socket => {
    socket.on('message', data => {
        console.log(data)
    })
})