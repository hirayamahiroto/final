
<x-admin-layout>
    <div class="mx-48 mt-40 border-gray-100 border-double">
        <form class="w-full max-w-lg" action="{{ route('companies.update', ['company' => $company->id]) }}" method="POST">
            @method('PUT')
            {{ csrf_field() }}
            <div class="flex flex-wrap -mx-3 mb-6">
                {{-- company name --}}
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="company-name">
                        Company Name
                    </label>
                    <input
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                        id="company-name" name="name" type="text" placeholder="Enter company name" value="{{ $company->name }}">
                </div>
                {{-- email --}}
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="company-email">
                        Email
                    </label>
                    <input
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                        id="company-email" name="email" type="email" placeholder="Enter email" value="{{ $company->email }}">
                </div>
                    {{-- password --}}
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="company-email">
                            Password
                        </label>
                        <input
                            class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                            id="company-password" name="password" type="password" placeholder="Enter email" value="{{ $company->password }}">
                    </div>

                            {{-- human name --}}
                            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                                <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="company-email">
                                    human name
                                </label>
                                <input
                                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                    id="company-human_name" name="human_name" type="text" placeholder="Enter email" value="{{ $company->human_name }}">
                            </div>


                {{-- industry --}}
                <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                    <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="company-industry">
                        Industry
                    </label>
                    <input
                        class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                        id="company-industry" name="industry" type="text" placeholder="Enter industry" value="{{ $company->industry }}">

                </div>
            </div>
            <div class="flex justify-center">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Update
                </button>
            </div>
        </form>

    </div>

</x-admin-layout>
