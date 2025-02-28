<template>
    <div
        :style="{ backgroundColor: getRandomColor }"
        class="avatar-icon w-10 h-10 !flex justify-center items-center"
        :class="{'min-w-[90px] min-h-[90px]':large}"
    >
        <div class="white--text">
            {{ initialText }}
        </div>
    </div>

</template>

<script lang="ts">

export default {
    name: 'Avatar',
    props:{
        uniqueName:{
            type:String,
            required:true
        },
        large:{
            type:Boolean,
            default:false
        }
    },
    data(){
        return {
            backgroundColors : ['#F44336', '#FF4081', '#9C27B0', '#673AB7', '#3F51B5', '#2196F3', '#03A9F4', '#00BCD4', '#009688', '#4CAF50', '#8BC34A', '#CDDC39', '#FFC107', '#FF9800', '#FF5722', '#795548', '#607D8B']
        };
    },
    computed:{
        getRandomColor() {
            // check for special characters
            const regex = /^[^a-z\d]+/gi;
            if(regex.test(this.uniqueName)) {
                return this.backgroundColors[0];
            }

            let firstLetter = this.uniqueName?.charAt(0);
            let index = isNaN(firstLetter) ? this.uniqueName?.toLowerCase().charCodeAt(0) - 97 : parseInt(firstLetter);
            if(index > this.backgroundColors.length) {
                index = (index % this.backgroundColors.length) - 1;
            }

            return  this.backgroundColors[index];
        },
        initialText(){
            return this.getInitials(this.uniqueName);
        }
    },
    methods: {
        getInitials(data) {
            if (data != null) {
                let chr;
                const d = data.toUpperCase();
                chr = d.split(' ');
                if (chr.length >= 2) {
                    return chr[0][0] + chr[1][0];
                } else {
                    return d[0] + d[1];
                }
            }
            return '';
        },
        /**------ algorithm for string to generate color----- */
        // stringToHslColor(str, s, l) {
        //     var hash = 0;
        //     for (var i = 0; i < str.length; i++) {
        //         hash = str.charCodeAt(i) + ((hash << 5) - hash);
        //     }

        //     var h = hash % 360;
        //     return 'hsl('+h+', '+s+'%, '+l+'%)';
        // }
    },
};
</script>

  <style scoped>
  .avatar-icon {
    display: inline-block;
    text-align: center;
    line-height: 2.4;
    color: #ffffff;
    font-weight: bold;
    border-radius: 50%;
  }
  </style>
