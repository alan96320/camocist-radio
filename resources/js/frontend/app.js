import '../bootstrap';
import '../plugins';
import Vue from 'vue';
import VueLocalStorage from 'vue-localstorage';
import VueMq from 'vue-mq'
import axios from 'axios';

window.Vue = Vue
Vue.use(VueLocalStorage)
Vue.use(VueMq, {
    breakpoints: { // default breakpoints - customize this
        sm: 450,
        md: 1250,
        lg: Infinity,
    },
    defaultBreakpoint: 'sm'
})

Vue.config.baseurl = process.env.BASE_URL

Vue.component(
    'lyric-component',
    require('./components/LyricComponent').default
)

new Vue({
    data() {
        return {
            radios: [{
                    // For 1nd radio player [883JIA]
                    uuid: 1,
                    audio_on: false,
                    audio_data: '',
                    mp3: 'https://playerservices.streamtheworld.com/api/livestream-redirect/883JIA.mp3',
                    channel_name: '883JIA',
                    display_name: '88.3JIA',
                    img: ''
                },
                {
                    // For 2nd radio player [883JIA_2]
                    uuid: 2,
                    audio_on: false,
                    audio_data: '',
                    mp3: 'https://playerservices.streamtheworld.com/api/livestream-redirect/JIA_WEBHITS_S01.mp3',
                    channel_name: 'JIA_WEBHITS_S01',
                    display_name: '88.3JIA网曲',
                    img: ''
                },
                {
                    // For 3rd radio player [883JIA_3]
                    uuid: 3,
                    audio_on: false,
                    audio_data: '',
                    mp3: 'https://playerservices.streamtheworld.com/api/livestream-redirect/JIA_KPOP_S01.mp3',
                    channel_name: 'JIA_KPOP_S01',
                    display_name: '88.3JIA K-POP',
                    img: ''
                },
                {
                    // For 4th radio player [power_98_hits]
                    uuid: 4,
                    audio_on: false,
                    audio_data: '',
                    mp3: 'https://playerservices.streamtheworld.com/api/livestream-redirect/POWER_98_HITS_S01.mp3',
                    channel_name: 'POWER_98_HITS_S01',
                    display_name: 'POWER HITS!',
                    img: ''
                },
                {
                    // For 5th radio player [power_98_ls]
                    uuid: 5,
                    audio_on: false,
                    audio_data: '',
                    mp3: 'https://playerservices.streamtheworld.com/api/livestream-redirect/POWER98_LOVESONGS.mp3',
                    channel_name: 'POWER98_LOVESONGS',
                    display_name: 'POWER 98 LOVE SONGS',
                    img: ''
                },
                {
                    //For 6th radio player [power_98]
                    uuid: 6,
                    audio_on: false,
                    audio_data: '',
                    mp3: 'https://playerservices.streamtheworld.com/api/livestream-redirect/POWER_98_RAW_S01.mp3',
                    channel_name: 'POWER_98_RAW_S01',
                    display_name: 'POWER 98 RAW',
                    img: ''
                }
            ],

            last_played: this.$localStorage.get('last_played') || 1,
            reactive_last_played: 1,
            header_audio: 1,
            banner_image: '/upload/timebelt/883JIA.png',

            song_title: 'WHEREVER YOU WILL GO',
            artist_name: 'CALLING',
            time_start: '0000',
            time_duration: '10000',
            program_id: 0,
            cover_art: '/img/frontend/Content-883JIA-logo.png',
            current_player: '',
            player: 0,
            player_name: '',
            algorithm: [],

            // lyric
            lyric: '',
            show_lyric: false,
            lyric_type: '',

            // timer
            g_timer: null,

            // lyric timer
            l_time: 0,
            l_is_running: false,
            lyric_interval: null,
            lyricLoading: true,

            ga_code: 'UA-142494701-1',
            ga_code_1: 'UA-142494701-2',
            ga_code_2: 'UA-142494701-3',
            ga_code_3: 'UA-142494701-4',
            ga_code_4: 'UA-142494701-6',
            ga_code_5: 'UA-142494701-7',
            ga_code_6: 'UA-142494701-5',
        }
    },
    computed: {
        cRequestIn() {
            return this.algorithm.request_in
        },
    },
    filters: {
        remove_underscore(value) {
            let newStr = value.replace(/_/g, " ")
            return newStr
        }
    },
    watch: {
        cRequestIn(value) {
            if (value <= 0) {
                let radio = this.radios.find(radio => radio.uuid == this.reactive_last_played)
                this.getPlayer(radio)
                this.resetLyricTimer();
            }
        }
    },
    methods: {
        async responseGetChannel(channel) {

            try {
                const {
                    data: data
                } = await axios.get(`/response-get-channel/${channel}`)
                this.banner_image = data.image
                this.time_duration = data.time_duration
                this.program_id = data.program_id
                this.song_title = data.title
                this.time_start = data.time_start
                this.artist_name = data.artist_name
                this.algorithm = data.algorithm
                this.cover_art = data.cover_art
                this.$nextTick(() => {
                    this.requestIn()
                    this.getLyric(channel)
                })

            } catch (error) {

                console.log('-----error-------')
                console.log(error.response.data)
                this.responseGetChannel(channel)
            }
        },
        async getLyric(channel) {
            this.lyricLoading = true
            const {
                data
            } = await axios.post(`get_songs_lyrics/${channel}`, {
                artist_name: this.artist_name,
                song_title: this.song_title,
                ads: this.algorithm.ads
            })
            
            this.lyric = data
            this.lyricLoading = false

            this.$nextTick(() => {
                // this.lyricTimer(data['now'], data['time_start'])
                let element  = document.getElementById('lyrics-load')
                if (element) element.scrollTop = 0
            })
        },
        async fetchChannelData(channel) {

            try {
                await axios.post('/api-post-channel', {
                    channel: channel
                })

            } catch (error) {

                console.log('-----error-------')
                console.log(error.response.data)
                this.fetchChannelData(channel)
            }
        },
        requestIn() {
            clearTimeout(this.g_timer)

            if (this.algorithm.request_in > 0) {
                this.g_timer = setTimeout(() => {
                    this.algorithm.request_in -= 1
                    this.requestIn()
                }, 1000)
            }
        },
        lyricTimer(now, start) {
            var n = (now-start)*1000;
            console.log('timer nya = '+n);
            this.$localStorage.set('start', start);
            this.$localStorage.set('now', now);
            this.$localStorage.set('timer', n);
            const self = this
            this.lyric_interval = setInterval(function () {
                ++self.algorithm.time_spend_in_second;
            }.bind(this), 800);
        },
        resetLyricTimer() {
            clearInterval(this.lyric_interval)
        },
        pause() {

            let radio = this.radios.find(radio => radio.uuid == this.reactive_last_played)

            radio.audio_on = false
            radio.audio_data.pause()
            this.header_audio = 0
            this.player = 0
        },
        resetData() {
            this.radios.forEach(radio => {
                if (radio.audio_data != '') {
                    radio.audio_on = false
                    radio.audio_data.pause()
                    this.header_audio = 0;
                    this.player = 0;
                }
            })
        },
        getPlayer(radio) {
            this.responseGetChannel(radio.channel_name)
            this.fetchChannelData(radio.channel_name)
        },
        showLyric(e) {
            this.show_lyric = true
            this.lyric_type = e.currentTarget.getAttribute('data-type')
        },
        closeLyric() {
            this.show_lyric = false
            this.lyric_type = ''
        },
        playRadio(radioId) {
            this.lyricLoading = true
            this.resetLyricTimer()
            this.resetData()

            if (!radioId) radioId = this.reactive_last_played

            let radio = this.radios.find(radio => radio.uuid == radioId)
            let audio = new Audio(radio.mp3)

            audio.autoplay = true
            audio.play()

            radio.audio_data = audio
            radio.audio_on = true

            this.header_audio = 1
            this.$localStorage.set('last_played', radio.uuid)
            this.player_name = radio.channel_name
            this.player = radio.uuid
            this.reactive_last_played = radio.uuid

            this.getPlayer(radio)
        },
        googleAnalytics(player_code) {

            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }

            gtag('js', new Date());
            gtag('config', player_code);
        },
    },
    created() {
        this.googleAnalytics(this.ga_code)
    },
    mounted() {
        this.playRadio(this.last_played)
    },
    beforeDestroy() {
        clearInterval(this.lyric_interval)
    }
}).$mount('#app')