@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <form action="{{ route('patients.update', $patient) }}" method="POST" class="w-full max-w-lg">
                    @csrf
                    @method('PUT')
                    <!-- Person Fields -->
                    <div class="mb-4">
                        <label for="first_name" class="block text-gray-700 text-sm font-bold mb-2">First Name:</label>
                        <input type="text" name="first_name" id="first_name" value="{{ old('first_name', $patient->person->first_name) }}"
                            required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="mb-4">
                        <label for="last_name" class="block text-gray-700 text-sm font-bold mb-2">Last Name:</label>
                        <input type="text" name="last_name" id="last_name" value="{{ old('last_name', $patient->person->last_name) }}"
                            required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="mb-4">
                        <label for="document" class="block text-gray-700 text-sm font-bold mb-2">Document:</label>
                        <input type="text" name="document" id="document" value="{{ old('document', $patient->person->document) }}"
                            required class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                        <input type="email" name="email" id="email" value="{{ old('email', $patient->person->email) }}" required
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="mb-4">
                        <label for="phone" class="block text-gray-700 text-sm font-bold mb-2">Phone:</label>
                        <input type="text" name="phone" id="phone" value="{{ old('phone', $patient->person->phone) }}" required
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="mb-4">
                        <label for="birth_date" class="block text-gray-700 text-sm font-bold mb-2">Birth Date:</label>
                        <input type="date" name="birth_date" id="birth_date"
                            value="{{ old('birth_date', $patient->person->birth_date) }}" required
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>
                    <div class="mb-4">
                        <label for="gender" class="block text-gray-700 text-sm font-bold mb-2">Gender:</label>
                        <select name="gender" id="gender" required
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            <option value="M" {{ old('gender', $patient->person->gender) == 'M' ? 'selected' : '' }}>Masculino</option>
                            <option value="F" {{ old('gender', $patient->person->gender) == 'F' ? 'selected' : '' }}>Femenino</option>
                        </select>
                    </div>

                    <!-- Patient Fields -->
                    <div class="mb-4">
                        <label for="health_insurance_id" class="block text-gray-700 text-sm font-bold mb-2">Health Insurance:</label>
                        <select name="health_insurance_id" id="health_insurance_id" required
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            @foreach ($healthInsurances as $healthInsurance)
                                <option value="{{ $healthInsurance->id }}"
                                    {{ old('health_insurance_id', $patient->health_insurance_id) == $healthInsurance->id ? 'selected' : '' }}>
                                    {{ $healthInsurance->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="affiliate_number" class="block text-gray-700 text-sm font-bold mb-2">Affiliate Number:</label>
                        <input type="text" name="affiliate_number" id="affiliate_number"
                            value="{{ old('affiliate_number', $patient->affiliate_number) }}" required
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>

                    <div class="flex items-center justify-between">
                        <button type="submit"
                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                            Actualizar Paciente
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
