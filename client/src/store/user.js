const user = {
    state: {
        userId: '',
        username: '',
        avator: '',
        // 用户收藏歌单、歌曲
        colSongList: [],
        colSong: []
    },
    getters: {
        userId: state => {
            let userId = state.userId
            if (!userId) {
                userId = JSON.parse(window.localStorage.getItem('userId') || null)
            }
            return userId
        },
        username: state => {
            let username = state.username
            if (!username) {
                username = JSON.parse(window.localStorage.getItem('username') || null)
            }
            return username
        },
        avator: state => {
            let avator = state.avator
            if (!avator) {
                avator = JSON.parse(window.localStorage.getItem('avator') || null)
            }
            return avator
        },
        // 获取用户收藏歌单
        colSongList: state => {
            let colSongList = state.colSongList
            if (!colSongList.length) {
                colSongList = JSON.parse(window.sessionStorage.getItem('colSongList') || null)
            }
            return colSongList
        },
        // 获取用户收藏歌曲
        colSong: state => {
            let colSong = state.colSong
            if (!colSong.length) {
                colSong = JSON.parse(window.sessionStorage.getItem('colSong') || null)
            }
            return colSong
        },
    },
    mutations: {
        setUserId: (state, userId) => {
            state.userId = userId
            window.localStorage.setItem('userId', JSON.stringify(userId))
        },
        setUsername: (state, username) => {
            state.username = username
            window.localStorage.setItem('username', JSON.stringify(username))
        },
        setAvator: (state, avator) => {
            state.avator = avator
            window.localStorage.setItem('avator', JSON.stringify(avator))
        },
        // 设置用户收藏歌单
        setColSongList: (state, colSongList) => {
            state.colSongList = colSongList
            window.sessionStorage.setItem('colSongList', JSON.stringify(colSongList))
        },
        // 设置用户收藏歌曲 
        setColSong: (state, colSong) => {
            state.colSong = colSong
            window.sessionStorage.setItem('colSong', JSON.stringify(colSong))
        },
    },
    actions: {}
}

export default user