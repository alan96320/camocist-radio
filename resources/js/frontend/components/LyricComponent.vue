<template>
    <div>
        <div v-for="(json, index) in jsons" :key="index">
            <span :id="`${json.milliseconds}`" :class="[{ 'muted-lyrics': type == 'sync' }, 'synn']">{{ json.line }}</span><br />
        </div>
    </div>
</template>

<script>
    export default {
        props: ['jsons', 'type', 'time'],
        data() {
            return {
                lastElem: '',
            }
        },
        methods: {
            highlight(milliseconds) {
                if (milliseconds !== undefined) {
                    let m = milliseconds / 1000
                    if (this.time >= Math.round(m)) {
                        console.log(milliseconds+' => '+ this.time);
                        
                        this.getLast()
                        return 'yes'
                    }
                }
            },
            getLast() {
                let someElementsItems = document.querySelectorAll(".yes")
                if (this.lastElem == someElementsItems[someElementsItems.length - 1]) {
                    return;
                }

                if (this.lastElem) this.lastElem.classList.remove('highlight')

                this.lastElem = someElementsItems[someElementsItems.length - 1]
                this.$nextTick(() => {
                    this.lastElem.classList.add('highlight')

                    // I am a good guy so I just leave this code here so in the future 
                    // if you want to scroll automatically to highlight the lines of the lyrics

                    //     if (this.lastElem !== undefined) {
                    //         let elemPosition = this.lastElem.offsetTop
                    //         let lyricsLoadHeight = document.getElementById('lyrics-load').offsetHeight
                    //         let y = elemPosition - lyricsLoadHeight / 2

                    //         $("#lyrics-load").animate({
                    //             scrollTop: y + "px"
                    //         }, {
                    //             easing: "swing",
                    //             duration: 500
                    //         });
                    //     }
                })
            },
        },
        mounted(){
            $.map(this.jsons, function (e, i) {
                if (e.milliseconds != undefined) {
                  setTimeout(() => {
                      if (i > 0) {
                          clearTimeout(i-1);
                      }
                      $('.synn').removeClass('highlight');
                      $('#'+e.milliseconds).addClass('highlight');
                      console.log(e.line);
                      
                  }, e.milliseconds);  
                }
            });
            console.log(this.jsons);
            
        }
    }
</script>

<style lang="scss" scoped>
    .muted-lyrics {
        color: #9a9a9a;
    }

    .highlight {
        color: #fff
    }

    .highlight--done {
        color: #9a9a9a;
    }
</style>