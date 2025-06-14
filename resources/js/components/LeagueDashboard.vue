<template>
    <div class="max-w-4xl mx-auto px-4 py-8">
        <h2 class="text-2xl font-semibold text-gray-800 mb-6">Standings</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Team</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Played</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">W</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">D</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">L</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">GD</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Points</th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                <tr v-for="s in standings" :key="s.team.id" class="hover:bg-gray-50">
                    <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">{{ s.team.name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-500">{{ s.played }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-500">{{ s.won }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-500">{{ s.draw }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-500">{{ s.lose }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-gray-500">{{ s.goal_difference }}</td>
                    <td class="px-6 py-4 whitespace-nowrap font-semibold text-gray-900">{{ s.points }}</td>
                </tr>
                </tbody>
            </table>
        </div>

        <h2 class="text-2xl font-semibold text-gray-800 mt-12 mb-6">Weekly Match Results</h2>
        <div class="relative">
            <div class="flex space-x-2 mb-4 overflow-x-auto pb-2">
                <button
                    v-for="(week, index) in weeklyResults"
                    :key="index"
                    @click="currentWeek = index"
                    :class="{
                        'bg-blue-600 text-white': currentWeek === index,
                        'bg-gray-200 text-gray-700 hover:bg-gray-300': currentWeek !== index
                    }"
                    class="px-4 py-2 rounded-md text-sm font-medium transition-colors"
                >
                    Week {{ week.id }}
                </button>
            </div>

            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="p-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Week {{ weeklyResults[currentWeek]?.id }}</h3>
                </div>
                <ul class="divide-y divide-gray-200">
                    <li
                        v-for="game in weeklyResults[currentWeek]?.games"
                        :key="game.id"
                        class="px-4 py-4"
                    >
                        <div class="flex items-center justify-between">
                            <span class="font-medium text-gray-900">{{ game.home_team?.name }}</span>
                            <span class="mx-4 text-gray-700">
                                {{ game?.home_team_goal }} - {{ game?.away_team_goal }}
                            </span>
                            <span class="font-medium text-gray-900">{{ game.away_team?.name }}</span>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <h2 class="text-2xl font-semibold text-gray-800 mt-12 mb-6">Championship Prediction</h2>
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <ul class="divide-y divide-gray-200">
                <li
                    v-for="(prediction, index) in predictions"
                    :key="index"
                    class="px-6 py-4 flex justify-between items-center"
                >
                    <span class="font-medium text-gray-900">{{ prediction.team }}</span>
                    <div class="flex items-center">
                        <span class="text-gray-700 mr-2">{{ prediction.chance }}%</span>
                        <div class="w-32 bg-gray-200 rounded-full h-2.5">
                            <div
                                class="bg-blue-600 h-2.5 rounded-full"
                                :style="{ width: `${prediction.chance}%` }"
                            ></div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        standings: Array,
        weeklyResults: Array,
        predictions: Array
    },
    data() {
        return {
            currentWeek: 0
        }
    }
}
</script>
