/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import Promise from 'promise-polyfill';
import '../bootstrap';
import '../plugins';
import Vue from 'vue';
import VueLocalStorage from 'vue-localstorage';
import axios from 'axios';

window.Vue = Vue;

Vue.use(VueLocalStorage);

Vue.config.baseurl = process.env.BASE_URL;


const app = new Vue({
    data() {
        return {
            //For first radio player
            audio_on: false,
            audio_data: '',
            playsound_1: 'https://playerservices.streamtheworld.com/api/livestream-redirect/883JIA.mp3',
            player_name: '883JIA',

            //For 2nd radio player
            audio_883JIA_2: false,
            audio_data_883JIA_2: '',
            playsound_2: 'https://playerservices.streamtheworld.com/api/livestream-redirect/JIA_WEBHITS_S01.mp3',

            //For 3rd radio player
            audio_883JIA_3: false,
            audio_data_883JIA_3: '',
            playsound_3: 'https://playerservices.streamtheworld.com/api/livestream-redirect/JIA_KPOP_S01.mp3',

            //For 4th radio player
            audio_power_98_hits: false,
            audio_data_power_98_hits: '',
            playsound_4: 'https://playerservices.streamtheworld.com/api/livestream-redirect/POWER_98_HITS_S01.mp3',

            //For 5th radio player
            audio_power_98_ls: false,
            audio_data_power_98_ls: '',
            playsound_5: 'https://playerservices.streamtheworld.com/api/livestream-redirect/POWER98_LOVESONGS.mp3',

            //For 6th radio player
            audio_power_98: false,
            audio_data_power_98: '',
            playsound_6: 'https://playerservices.streamtheworld.com/api/livestream-redirect/POWER_98_RAW_S01.mp3',

            last_played: 1,
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
            algorithm: [],

            ga_code: 'UA-142494701-1',
            ga_code_1: 'UA-142494701-2',
            ga_code_2: 'UA-142494701-3',
            ga_code_3: 'UA-142494701-4',
            ga_code_4: 'UA-142494701-6',
            ga_code_5: 'UA-142494701-7',
            ga_code_6: 'UA-142494701-5',

        };
    },
    methods: {
        fetchChannelData(channel) {
            axios.post('/api-post-channel', { channel: channel })
                .then(() => {

                    setTimeout(function () {
                        this.fetchChannelData(channel)
                    }.bind(this), 10000)

                }).catch(error => {

                    setTimeout(function () {
                        this.fetchChannelData(channel)
                    }.bind(this), 10000)

                    console.log('-----error-------');
                    console.log(error);
                })
        },
        playSound() {
			var sound = this.playsound_1;
            if (sound) {
                // Pause Other player 
                this.check_other_player();

				var audio = new Audio(sound);
				window.__audio__ = audio
                this.audio_data = audio;

                audio.autoplay = true;
                audio.play();

                this.audio_on = true;
                this.last_played = 1;
                this.header_audio = 1;
                this.$localStorage.set('last_player', this.last_played);
                this.player_name = '883JIA';
                this.player = 1;

                this.google_analytics(this.ga_code_1);

                this.response_883jia();
                /*var promise = audio.play();
				if (promise !== undefined) {
				    promise.then(_ => {
				     
					    audio.autoplay = true;
					    audio.play();

				      this.audio_on = true;
				      this.last_played = 1;
				      this.header_audio = 1;
				      this.$localStorage.set('last_player', this.last_played);
				      this.player_name = '883JIA';
				      this.player = 1;

				      this.google_analytics(this.ga_code_1);

				      this.response_883jia();
				    })
				    .catch(error => {
				      audio.pause();
				    });
				}*/
            }
        },
        response_883jia() {
            axios.get('/response_883jia')
                .then(response => {
                    console.log(response.data);
                    if (response.data.image == '') {
                        this.banner_image = '/upload/timebelt/1200_800_' + response.data.default_image;
                    } else {
                        this.banner_image = '/upload/timebelt/1200_800_' + response.data.image;
                    }

                    this.song_title = response.data.title;
                    this.artist_name = response.data.artist_name;

                    if (response.data.cover_art != '') {
                        this.cover_art = response.data.cover_art;
                    } else {
                        this.cover_art = '/img/frontend/Content-883JIA-logo.png';
                    }
                })
                .catch(error => {
                    console.log('-----error-------');
                    console.log(error);
                })
        },
        stopSound() {
			var sound = this.playsound_1;
			// var sound = 'https://www.mboxdrive.com/Beyonc%C3%A9%20-%20Halo.mp3';
            if (sound) {
                this.audio_on = false;
                this.header_audio = 0;
                this.player = 0;
                this.audio_data.pause();
            }
        },
        playSound_883JIA_2() {
            var sound = this.playsound_2;
            if (sound) {
                this.check_other_player();

                var audio = new Audio(sound);
                window.__audio__ = audio
                this.audio_data_883JIA_2 = audio;

                audio.autoplay = true;
                audio.play();
                this.audio_883JIA_2 = true;
                this.last_played = 2;
                this.header_audio = 2;
                this.$localStorage.set('last_player', this.last_played);
                this.player_name = '883JIA WEBHITS';
                this.player = 2;

                this.google_analytics(this.ga_code_2);

                this.response_883jia_2();
                //audio.play();
                /*var promise = audio.play();
				if (promise !== undefined) {
				    promise.then(_ => {
				      audio.autoplay = true;	
				      audio.play();
				      this.audio_883JIA_2 = true;
				      this.last_played = 2;
				      this.header_audio = 2;
				      this.$localStorage.set('last_player', this.last_played);
				      this.player_name = '883JIA WEBHITS';
				      this.player = 2;

				      this.google_analytics(this.ga_code_2);

				      this.response_883jia_2();
				    })
				    .catch(error => {
				      audio.pause();
				    });
				  }*/
            }
        },
        response_883jia_2() {
            axios.get('/response_883jia_2')
                .then(response => {
                    console.log(response.data);
                    this.banner_image = '/upload/timebelt/1200_800_' + response.data.default_image;
                    this.song_title = response.data.title;
                    this.time_start = response.data.time_start;
                    this.artist_name = response.data.artist_name;
                    if (response.data.cover_art != '') {
                        this.cover_art = response.data.cover_art;
                    } else {
                        this.cover_art = '/img/frontend/Content-883JIA_2-logo.png';
                    }

                })
                .catch(error => {
                    console.log('-----error-------');
                    console.log(error);
                })
        },
        stopSound_883JIA_2() {
            var sound = this.playsound_2;
            if (sound) {
                this.audio_883JIA_2 = false;
                this.header_audio = 0;
                this.player = 0;
                this.audio_data_883JIA_2.pause();
            }
        },
        playSound_883JIA_3() {
            var sound = this.playsound_3;
            if (sound) {
                this.check_other_player();

                var audio = new Audio(sound);
                window.__audio__ = audio
                this.audio_data_883JIA_3 = audio;

                audio.autoplay = true;
                audio.play();
                this.audio_883JIA_3 = true;
                this.last_played = 3;
                this.header_audio = 3;
                this.$localStorage.set('last_player', this.last_played);
                this.player_name = '883JIA KPOP';
                this.player = 3;

                this.google_analytics(this.ga_code_3);

                this.response_883jia_3();
                //audio.play();
                /*var promise = audio.play();
				if (promise !== undefined) {
				    promise.then(_ => {
				      audio.autoplay = true;
				      audio.play();
				      this.audio_883JIA_3 = true;
				      this.last_played = 3;
				      this.header_audio = 3;
				      this.$localStorage.set('last_player', this.last_played);
				      this.player_name = '883JIA KPOP';
				      this.player = 3;

				      this.google_analytics(this.ga_code_3);

				      this.response_883jia_3();
				    })
				    .catch(error => {
				      audio.pause();
				    });
				  }*/
            }
        },
        response_883jia_3() {
            axios.get('/response_883jia_3')
                .then(response => {
                    console.log(response.data);
                    this.banner_image = '/upload/timebelt/1200_800_' + response.data.default_image;
                    this.song_title = response.data.title;
                    this.time_start = response.data.time_start;
                    this.artist_name = response.data.artist_name;
                    if (response.data.cover_art != '') {
                        this.cover_art = response.data.cover_art;
                    } else {
                        this.cover_art = '/img/frontend/Content-883JIA-K-Pop-logo.png';
                    }
                })
                .catch(error => {
                    console.log('-----error-------');
                    console.log(error);
                })
        },
        stopSound_883JIA_3() {
            var sound = this.playsound_3;
            if (sound) {
                this.audio_883JIA_3 = false;
                this.header_audio = 0;
                this.player = 0;
                this.audio_data_883JIA_3.pause();
            }
        },
        playSound_power_98() {
            var sound = this.playsound_6;
            if (sound) {
                this.check_other_player();

                var audio = new Audio(sound);
                window.__audio__ = audio
                this.audio_data_power_98 = audio;

                audio.autoplay = true;
                audio.play();
                this.audio_power_98 = true;
                this.last_played = 6;
                this.header_audio = 6;
                this.$localStorage.set('last_player', this.last_played);
                this.player_name = 'POWER98 RAW';
                this.player = 6;

                this.google_analytics(this.ga_code_6);

                this.response_power_98();

                //audio.play();
                /*var promise = audio.play();
				if (promise !== undefined) {
				    promise.then(_ => {
				      audio.autoplay = true;	
				      audio.play();
				      this.audio_power_98 = true;
				      this.last_played = 6;
				      this.header_audio = 6;
				      this.$localStorage.set('last_player', this.last_played);
				      this.player_name = 'POWER98 RAW';
				      this.player = 6;

				      this.google_analytics(this.ga_code_6);

				      this.response_power_98();
				    })
				    .catch(error => {
				      audio.pause();
				    });
				  }*/
            }
        },
        response_power_98() {
            axios.get('/response_power_98')
                .then(response => {
                    console.log(response.data);
                    if (response.data.image == '') {
                        this.banner_image = '/upload/timebelt/1200_800_' + response.data.default_image;
                    } else {
                        this.banner_image = '/upload/timebelt/1200_800_' + response.data.image;
                    }
                    this.song_title = response.data.title;
                    this.time_start = response.data.time_start;
                    this.artist_name = response.data.artist_name;
                    if (response.data.cover_art != '') {
                        this.cover_art = response.data.cover_art;
                    } else {
                        this.cover_art = '/img/frontend/Content-Power-98-logo.png';
                    }
                })
                .catch(error => {
                    console.log('-----error-------');
                    console.log(error);
                })
        },
        stopSound_power_98() {
            var sound = this.playsound_6;
            if (sound) {
                this.audio_power_98 = false;
                this.header_audio = 0;
                this.player = 0;
                this.audio_data_power_98.pause();
            }
        },
        playSound_power_98_hits() {
            var sound = this.playsound_4;
            if (sound) {
                this.check_other_player();

                var audio = new Audio(sound);
                window.__audio__ = audio
                this.audio_data_power_98_hits = audio;

                audio.autoplay = true;
                audio.play();
                this.audio_power_98_hits = true;
                this.last_played = 4;
                this.header_audio = 4;
                this.$localStorage.set('last_player', this.last_played);
                this.player_name = 'POWER98 HITS';
                this.player = 4;

                this.google_analytics(this.ga_code_4);

                this.response_power_98_hits();
                //audio.play();
                /*var promise = audio.play();
				if (promise !== undefined) {
				    promise.then(_ => {
				      audio.autoplay = true;
				      audio.play();
				      this.audio_power_98_hits = true;
				      this.last_played = 4;
				      this.header_audio = 4;
				      this.$localStorage.set('last_player', this.last_played);
				      this.player_name = 'POWER98 HITS';
				      this.player = 4;

				      this.google_analytics(this.ga_code_4);

				      this.response_power_98_hits();
				    })
				    .catch(error => {
				      audio.pause();
				    });
				  }*/
            }
        },
        response_power_98_hits() {
            axios.get('/response_power_98_hits')
                .then(response => {
                    console.log(response.data);
                    this.banner_image = '/upload/timebelt/1200_800_' + response.data.default_image;
                    this.song_title = response.data.title;
                    this.time_start = response.data.time_start;
                    this.artist_name = response.data.artist_name;
                    if (response.data.cover_art != '') {
                        this.cover_art = response.data.cover_art;
                    } else {
                        this.cover_art = '/img/frontend/Content-Power-98-hits!-logo.png';
                    }
                })
                .catch(error => {
                    console.log('-----error-------');
                    console.log(error);
                })
        },
        stopSound_power_98_hits() {
            var sound = this.playsound_4;
            if (sound) {
                this.audio_power_98_hits = false;
                this.header_audio = 0;
                this.player = 0;
                this.audio_data_power_98_hits.pause();
            }
        },
        playSound_power_98_ls() {
            var sound = this.playsound_5;
            if (sound) {
                this.check_other_player();

                var audio = new Audio(sound);
                window.__audio__ = audio
                this.audio_data_power_98_ls = audio;

                audio.autoplay = true;
                audio.play();
                this.audio_power_98_ls = true;
                this.last_played = 5;
                this.header_audio = 5;
                this.$localStorage.set('last_player', this.last_played);
                this.player_name = 'POWER98 LOVE SONGS';
                this.player = 5;

                this.google_analytics(this.ga_code_5);

                this.response_power_98_ls();
                //audio.play();
                /*var promise = audio.play();
				if (promise !== undefined) {
				    promise.then(_ => {
				      audio.autoplay = true;
				      audio.play();
				      this.audio_power_98_ls = true;
				      this.last_played = 5;
				      this.header_audio = 5;
				      this.$localStorage.set('last_player', this.last_played);
				      this.player_name = 'POWER98 LOVE SONGS';
				      this.player = 5;
				      
				      this.google_analytics(this.ga_code_6);

				      this.response_power_98_ls();
				    })
				    .catch(error => {
				      audio.pause();
				    });
				  }*/
            }
        },
        response_power_98_ls() {
            axios.get('/response-get-channel/POWER98_LOVESONGS')
                .then(response => {
                    console.log(response.data);
                    //this.banner_image = 'upload/timebelt/1200_800_' + response.data.default_image; 
                    if (response.data.image == '') {
                        this.banner_image = '/upload/timebelt/1200_800_' + response.data.default_image;
                    } else {
                        this.banner_image = '/upload/timebelt/1200_800_' + response.data.image;
                    }
                    this.time_duration = response.data.time_duration
                    this.program_id = response.data.program_id
                    this.song_title = response.data.title;
                    this.time_start = response.data.time_start;
                    this.artist_name = response.data.artist_name;

                    window.__ALGORITM__ = response.data.algorithm
                    this.algorithm = response.data.algorithm

                    if (response.data.cover_art != '') {
                        this.cover_art = response.data.cover_art;
                    } else {
                        this.cover_art = '/img/frontend/Content-Power-98-Love-Song-logo.png';
                    }
                })
                .catch(error => {
                    console.log('-----error-------');
                    console.log(error);
                })
        },
        stopSound_power_98_ls() {
            var sound = this.playsound_5;
            if (sound) {
                this.audio_power_98_ls = false;
                this.header_audio = 0;
                this.player = 0;
                this.audio_data_power_98_ls.pause();
            }
        },
        check_other_player() {
            if (this.audio_data != '') {
                this.audio_on = false;
                this.header_audio = 0;
                this.player = 0;
                this.audio_data.pause();
            }
            if (this.audio_data_883JIA_2 != '') {
                this.audio_883JIA_2 = false;
                this.header_audio = 0;
                this.player = 0;
                this.audio_data_883JIA_2.pause();
            }
            if (this.audio_data_883JIA_3 != '') {
                this.audio_883JIA_3 = false;
                this.header_audio = 0;
                this.player = 0;
                this.audio_data_883JIA_3.pause();
            }
            if (this.audio_data_power_98 != '') {
                this.audio_power_98 = false;
                this.header_audio = 0;
                this.player = 0;
                this.audio_data_power_98.pause();
            }
            if (this.audio_data_power_98_hits != '') {
                this.audio_power_98_hits = false;
                this.header_audio = 0;
                this.player = 0;
                this.audio_data_power_98_hits.pause();
            }
            if (this.audio_data_power_98_ls != '') {
                this.audio_power_98_ls = false;
                this.header_audio = 0;
                this.player = 0;
                this.audio_data_power_98_ls.pause();
            }
        },
        get_player() {
            if (this.player == 1) {
                this.response_883jia();
            }
            if (this.player == 2) {
                this.response_883jia_2();
            }
            if (this.player == 3) {
                this.response_883jia_3();
            }
            if (this.player == 4) {
                this.response_power_98_hits();
            }
            if (this.player == 5) {
                this.response_power_98_ls();
            }
            if (this.player == 6) {
                this.response_power_98();
            }

        },
        google_analytics(player_code) {

            window.dataLayer = window.dataLayer || [];

            function gtag() {
                dataLayer.push(arguments);
            }

            gtag('js', new Date());
            gtag('config', player_code);
        }
    },

    created() {
        setInterval(() => this.get_player(), process.env.MIX_TIME_INTERVAL);

        this.google_analytics(this.ga_code);
    },
    mounted() {
        window.addEventListener('load', () => {

			var get_last_player = this.$localStorage.get('last_player');
			console.log(get_last_player)
            if (get_last_player == 1) {
                this.audio_on = true;
                this.player = 1;
                this.playSound(this.playsound_1);
                this.fetchChannelData('883JIA');
            } else if (get_last_player == 2) {
                this.audio_883JIA_2 = true;
                this.player = 2;
                this.playSound_883JIA_2(this.playsound_2);
                this.fetchChannelData('JIA_WEBHITS_S01');
                //this.google_analytics(this.ga_code_2);
            } else if (get_last_player == 3) {
                this.audio_883JIA_3 = true;
                this.player = 3;
                this.playSound_883JIA_3(this.playsound_3);
                this.fetchChannelData('JIA_KPOP_S01');
                //this.google_analytics(this.ga_code_3);
            } else if (get_last_player == 4) {
                this.audio_power_98_hits = true;
                this.player = 4;
                this.playSound_power_98_hits(this.playsound_4);
                //this.google_analytics(this.ga_code_5);
                this.fetchChannelData('POWER_98_HITS_S01')
            } else if (get_last_player == 5) {
                this.audio_power_98_ls = true;
                this.player = 5;
                this.playSound_power_98_ls(this.playsound_5);
                this.fetchChannelData('POWER98_LOVESONGS')
                //this.google_analytics(this.ga_code_6);
            } else if (get_last_player == 6) {
                this.audio_power_98 = true;
                this.player = 6;
                this.playSound_power_98(this.playsound_6);
                //this.google_analytics(this.ga_code_4);
                this.fetchChannelData('POWER_98_RAW_S01');
            } else {
                this.audio_on = true;
                this.player = 1;
                this.playSound(this.playsound_1);
                //this.google_analytics(this.ga_code_1);
                this.fetchChannelData('883JIA');
            }
        })
    }
}).$mount('#app')