import { ICON } from '../assets/icon/index'

const song = {
    state: {
        isPlay: false, //播放状态
        PlayButtonUrl: ICON.BOFANG, // 播放状态的图标
        volume: 50, //默认音量
        id: '', //先设为1,---------后面写接口获取
        url: '', //测试歌曲---------后面写接口获取
        duration: 0, //  音乐时长
        curTime: 0, // 当前音乐的播放位置
        changeTime: 0, //  指定播放时刻
        title: '快点击音乐开始听歌吧~', //  歌名
        artist: '', //  歌手名
        picUrl: ICON.DJ, // 歌曲图片
        autoNext: true, // 用于触发自动播放下一首
        lyric: [], // 未处理的歌词数据
        listOfSongs: [], //播放列表
        // playList: [], //播放列表
        listSongs: [], //当前歌单列表
        tempList: {}, // 当前歌单信息
        listIndex: null, // 当前歌曲在歌曲列表的位置
    },
    getters: {
        isPlay: state => state.isPlay,
        playButtonUrl: state => {
            let playButtonUrl = state.playButtonUrl
            if (!playButtonUrl) {
                playButtonUrl = JSON.parse(window.sessionStorage.getItem('playButtonUrl') || null)
            }
            return playButtonUrl
        },
        // 音量
        volume: state => {
            let volume = state.volume
            if (!volume) {
                volume = JSON.parse(window.sessionStorage.getItem('volume') || null)
            }
            return volume
        },
        // 音乐id
        id: state => {
            let id = state.id
            if (!id) {
                id = JSON.parse(window.sessionStorage.getItem('id') || null)
            }
            return id
        },
        //   音乐链接
        url: state => {
            let url = state.url
            if (!url) {
                url = JSON.parse(window.sessionStorage.getItem('url') || null)
            }
            return url
        },
        //   音乐时长
        duration: state => {
            let duration = state.duration
            if (!duration) {
                duration = JSON.parse(window.sessionStorage.getItem('duration') || 0)
            }
            return duration
        },
        //   当前进度时间
        curTime: state => {
            let curTime = state.curTime
            if (!curTime) {
                curTime = JSON.parse(window.sessionStorage.getItem('curTime') || 0)
            }
            return curTime
        },
        //   拖动时间
        changeTime: state => {
            let changeTime = state.changeTime
            if (!changeTime) {
                changeTime = JSON.parse(window.sessionStorage.getItem('changeTime') || 0)
            }
            return changeTime
        },
        title: state => {
            let title = state.title
            if (!title) {
                title = JSON.parse(window.sessionStorage.getItem('title') || null)
            }
            return title
        },
        //   歌手 
        artist: state => {
            let artist = state.artist
            if (!artist) {
                artist = JSON.parse(window.sessionStorage.getItem('artist') || null)
            }
            return artist
        },
        //   音乐封面
        picUrl: state => {
            let picUrl = state.picUrl
            if (!picUrl) {
                picUrl = JSON.parse(window.sessionStorage.getItem('picUrl')) || `${BASE_URL}/img/songPic/tubiao.jpg`
            }
            return picUrl
        },
        autoNext: state => {
            let autoNext = state.autoNext
            if (!autoNext) {
                autoNext = JSON.parse(window.sessionStorage.getItem('autoNext') || null)
            }
            return autoNext
        },
        // 当前歌单信息
        tempList: state => {
            let tempList = state.tempList
            if (JSON.stringify(tempList) === '{}') {
                tempList = JSON.parse(window.sessionStorage.getItem('tempList') || null)
            }
            return tempList
        },
        listOfSongs: state => {
            let listOfSongs = state.listOfSongs
            if (!listOfSongs.length) {
                listOfSongs = JSON.parse(window.sessionStorage.getItem('listOfSongs') || null)
            }
            return listOfSongs
        },
        listSongs: state => {
            let listSongs = state.listSongs
            if (!listSongs.length) {
                listSongs = JSON.parse(window.sessionStorage.getItem('listSongs') || null)
            }
            return listSongs
        },
        listIndex: state => {
            let listIndex = state.listIndex
            if (!listIndex) {
                listIndex = JSON.parse(window.sessionStorage.getItem('listIndex') || null)
            }
            return listIndex
        },
        // 歌词
        lyric: state => {
            let lyric = state.lyric
            if (lyric.length === 0) {
                lyric = JSON.parse(window.sessionStorage.getItem('lyric') || null)
            }
            return lyric
        },
        // 
    },
    mutations: {
        setIsPlay: (state, isPlay) => {
            state.isPlay = isPlay
            window.sessionStorage.setItem('isPlay', JSON.stringify(isPlay))
        },
        setPlayButtonUrl: (state, playButtonUrl) => {
            state.playButtonUrl = playButtonUrl
            window.sessionStorage.setItem('playButtonUrl', JSON.stringify(playButtonUrl))
        },
        setVolume: (state, volume) => {
            state.volume = volume
            window.sessionStorage.setItem('volume', JSON.stringify(volume))
        },
        setId: (state, id) => {
            state.id = id
            window.sessionStorage.setItem('id', JSON.stringify(id))
        },
        setUrl: (state, url) => {
            state.url = url
            window.sessionStorage.setItem('url', JSON.stringify(url))
        },
        setDuration: (state, duration) => {
            state.duration = duration
            window.sessionStorage.setItem('duration', JSON.stringify(duration))
        },
        setCurTime: (state, curTime) => {
            state.curTime = curTime
            window.sessionStorage.setItem('curTime', JSON.stringify(curTime))
        },
        setChangeTime: (state, changeTime) => {
            state.changeTime = changeTime
            window.sessionStorage.setItem('changeTime', JSON.stringify(changeTime))
        },
        setTitle: (state, title) => {
            state.title = title
            window.sessionStorage.setItem('title', JSON.stringify(title))
        },
        setArtist: (state, artist) => {
            state.artist = artist
            window.sessionStorage.setItem('artist', JSON.stringify(artist))
        },
        setpicUrl: (state, picUrl) => {
            state.picUrl = picUrl
            window.sessionStorage.setItem('picUrl', JSON.stringify(picUrl))
        },
        setAutoNext: (state, autoNext) => {
            state.autoNext = autoNext
            window.sessionStorage.setItem('autoNext', JSON.stringify(autoNext))
        },
        // 设置点击歌单id
        setTempList: (state, tempList) => {
            state.tempList = tempList
            window.sessionStorage.setItem('tempList', JSON.stringify(tempList))
        },
        setListOfSongs: (state, listOfSongs) => {
            state.listOfSongs = listOfSongs
            window.sessionStorage.setItem('listOfSongs', JSON.stringify(listOfSongs))
        },
        setListSongs: (state, listSongs) => {
            state.listSongs = listSongs
            window.sessionStorage.setItem('listSongs', JSON.stringify(listSongs))
        },
        // 选择上一首下一首时用
        setListIndex: (state, listIndex) => {
            state.listIndex = listIndex
            window.sessionStorage.setItem('listIndex', JSON.stringify(listIndex))
        },
        // 设置歌词
        setLyric: (state, lyric) => {
            state.lyric = lyric
            window.sessionStorage.setItem('lyric', JSON.stringify(lyric))
        },
    },
    actions: {}
}
export default song