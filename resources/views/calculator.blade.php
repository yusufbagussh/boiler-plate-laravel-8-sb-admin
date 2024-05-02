<!DOCTYPE html>
<html>

<head>
    <title>Kalkulator Laravel</title>
</head>

<body>
    <h1>Kalkulator Laravel</h1>

    <form action="{{ route('calculator.calculate') }}" method="post">
        @csrf
        <input type="text" name="operand1" placeholder="Operand 1" required>
        <select name="operator">
            <option value="+">+</option>
            <option value="-">-</option>
            <option value="*">*</option>
            <option value="/">/</option>
        </select>
        <input type="text" name="operand2" placeholder="Operand 2" required>
        <button type="submit">Hitung</button>
    </form>

    <h2>Daftar Perhitungan</h2>
    <table>
        <thead>
            <tr>
                <th>Operand 1</th>
                <th>Operator</th>
                <th>Operand 2</th>
                <th>Hasil</th>
                <th>Waktu</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($calculations as $calculation)
                <tr>
                    <td>{{ $calculation->operand1 }}</td>
                    <td>{{ $calculation->operator }}</td>
                    <td>{{ $calculation->operand2 }}</td>
                    <td>{{ $calculation->result }}</td>
                    <td>{{ $calculation->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $calculations->links() }}
</body>

</html>
