<script setup>
defineProps({
    statSubtitle: {
        type: String,
        default: 'Traffic'
    },
    statTitle: {
        type: String,
        default: '350,897'
    },
    statArrow: {
        default: 'up',
        validator: function (value) {
            return ['up', 'down'].indexOf(value) !== -1;
        }
    },

    statPercent: {
        type: String,
        default: '3.48'
    },

    statPercentColor: {
        type: String,
        default: 'text-emerald-500'
    },

    statDescription: {
        type: String,
        default: 'Since last month'
    },
    statIconName: {
        type: String,
        default: 'far fa-chart-bar'
    },

    statIconColor: {
        type: String,
        default: 'bg-red-500'
    }
});
</script>

<template>
    <div
        class="relative flex flex-col min-w-0 break-words bg-white border rounded-md mb-6 xl:mb-0 shadow shadow-gray-200"
    >
        <div class="flex-auto p-4">
            <div class="flex flex-wrap">
                <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                    <h5 class="text-slate-500 font-bold text-xs">
                        {{ statSubtitle }}
                    </h5>
                    <span class="font-semibold text-xl text-slate-800">
                        {{ statTitle }}
                    </span>
                </div>
                <div class="relative w-auto pl-4 flex-initial">
                    <div
                        class="text-white p-3 text-center inline-flex items-center justify-center w-12 h-12 shadow-lg rounded-md"
                        :class="[statIconColor]"
                    >
                        <i :class="[statIconName]" />
                    </div>
                </div>
            </div>
            <p class="text-xs text-slate-500 font-medium mt-4">
                <span class="mr-2" :class="[statPercentColor]">
                    <i
                        :class="[
                            statArrow === 'up' ? `fa-solid fa-arrow-trend-up` : `fa-solid fa-arrow-trend-down`
                        ]"
                    />
                    {{ statPercent }}%
                </span>
                <span class="whitespace-nowrap">{{ statDescription }}</span>
            </p>
        </div>
    </div>
</template>
