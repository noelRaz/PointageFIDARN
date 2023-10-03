<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-white dark:text-white">
            {{ __('Supprimer le compte') }}
        </h2>

        <p class="mt-1 text-sm text-white dark:text-white">
            {{ __('Une fois votre compte supprimé, toutes ses ressources et données seront définitivement supprimées. Avant de supprimer votre compte, veuillez télécharger les données ou informations que vous souhaitez conserver.') }}
        </p>
    </header>

    <button class="btn btn-danger mt-2"
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">
        {{ __('Supprimer') }}
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="bg-dark rounded text-lg font-medium text-white dark:text-white">
                {{ __('Voulez-vous vraiment supprimer votre compte?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Une fois votre compte supprimé, toutes ses ressources et données seront définitivement supprimées, veuillez entrer votre mot de passe pour confirmer que vous souhaiter supprimer définitivement votre compte.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('Password') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Annuler') }}
                </x-secondary-button>

                <button class="btn btn-danger ml-3">
                    {{ __('Supprimer') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>
