import { BASE_URL } from '../api/config'

const configure = {
    state: {
        HOST: BASE_URL,
        loginIn: false, // 用户是否登录
        // searchword: '', // 搜索关键词
        // showAside: false, // 是否显示侧边栏
        // activeName: '', // 歌单类型名
        // index: 0, // 列表中的序号
        isActive: false
    },
    getters: {
        isActive: state => {
            let isActive = state.isActive
            if (!isActive) {
                isActive = JSON.parse(window.sessionStorage.getItem('isActive') || null)
            }
            return isActive
        },
        loginIn: state => {
            let loginIn = state.loginIn
            if (!loginIn) {
                loginIn = JSON.parse(window.sessionStorage.getItem('loginIn') || null)
            }
            return loginIn
        },

    },
    mutations: {
        setIsActive: (state, isActive) => {
            state.isActive = isActive
            window.sessionStorage.setItem('isActive', JSON.stringify(isActive))
        },
        setLoginIn: (state, loginIn) => {
            state.loginIn = loginIn
            window.sessionStorage.setItem('loginIn', JSON.stringify(loginIn))
        },

    },
    actions: {}
}

export default configure