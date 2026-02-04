<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link, router, useForm } from '@inertiajs/vue3';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow, } from '@/components/ui/table'
import { Trash2, ChevronRight } from 'lucide-vue-next';
import Input from '@/components/ui/input/Input.vue';
import Label from '@/components/ui/label/Label.vue';
import InputError from '@/components/InputError.vue';
import Button from '@/components/ui/button/Button.vue';
import { nextEpisode, nextSeason, store, toggleVPN } from '@/actions/App/Http/Controllers/ProgramController';
import { destroy } from '@/routes/programs';
import Checkbox from '@/components/ui/checkbox/Checkbox.vue';


interface Program {
    id: number,
    program: string,
    app: string,
    season: number,
    episode: number,
    use_vpn: boolean,
}

defineProps<{ programs: Program[] }>();

const form = useForm({
    program: '',
    app: '',
    season: 1,
    episode: 1,
    use_vpn: true,
})

const submit = () => {
    form.post(store.url(), {
        preserveScroll: true,
        onSuccess: () => form.reset(),
    })
}

const vpnChange = (program: Program) => {
    router.put(toggleVPN.url(program))
}

</script>

<template>

    <Head title="Dashboard" />

    <AppLayout>
        <div class="md:m-2">
            <Table>
                <TableHeader>
                    <TableRow>
                        <TableHead>Program</TableHead>
                        <TableHead>App</TableHead>
                        <TableHead>Season</TableHead>
                        <TableHead>Episode</TableHead>
                        <TableHead>Use Vpn</TableHead>
                        <TableHead>Delete</TableHead>
                    </TableRow>
                </TableHeader>
                <TableBody>
                    <TableRow v-for="program in programs" :key="program.id" class="bg-teal-50 dark:bg-zinc-900">
                        <TableCell>{{ program.program }}</TableCell>
                        <TableCell>{{ program.app }}</TableCell>
                        <TableCell>{{ program.season }}
                            <Link :href="nextSeason(program)">
                                <Button size="sm"
                                    class="ml-1 bg-teal-500 text-teal-950 hover:text-white hover:bg-teal-900">
                                    <ChevronRight />
                                </Button>
                            </Link>
                        </TableCell>
                        <TableCell>{{ program.episode }}
                            <Link :href="nextEpisode(program)">
                                <Button size="sm"
                                    class="ml-1 bg-teal-500 text-teal-950 hover:text-white hover:bg-teal-900">
                                    <ChevronRight />
                                </Button>
                            </Link>
                        </TableCell>
                        <TableCell>
                            <Checkbox v-model="program.use_vpn" v-on:click="vpnChange(program)" />
                        </TableCell>
                        <TableCell>

                            <Link :href="destroy(program)" method="delete">
                                <Trash2 class="text-red-500 cursor-pointer" />
                            </Link>
                        </TableCell>

                    </TableRow>
                </TableBody>
            </Table>

            <form @submit.prevent="submit">
                <Label>Program:</Label>
                <Input v-model="form.program" />
                <InputError :message="form.errors.program" />
                <Label>App:</Label>
                <Input v-model="form.app" />
                <InputError :message="form.errors.app" />

                <Label>Season:</Label>
                <Input v-model="form.season" />
                <InputError :message="form.errors.season" />
                <Label>Episode:</Label>
                <Input v-model="form.episode" />
                <InputError :message="form.errors.episode" />

                <Label>UseVPN:
                    <Checkbox v-model="form.use_vpn" />
                </Label>
                <Button class="mt-4">Add Program</Button>

            </form>
        </div>
    </AppLayout>

</template>
