<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório Diário de Vendas</title>
</head>
<body>
    <h1>Olá, {{ $seller->name }}</h1>
    <p>Aqui está o seu relatório de vendas do dia:</p>

    <table border="1" cellspacing="0" cellpadding="5">
        <thead>
            <tr>
                <th>Valor da Venda</th>
                <th>Comissão</th>
                <th>Data</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sales as $sale)
                <tr>
                    <td>R$ {{ number_format($sale->amount, 2, ',', '.') }}</td>
                    <td>R$ {{ number_format($sale->commission, 2, ',', '.') }}</td>
                    <td>{{ $sale->created_at->format('d/m/Y H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p>Total de Vendas: R$ {{ number_format($sales->sum('amount'), 2, ',', '.') }}</p>
    <p>Total de Comissão: R$ {{ number_format($sales->sum('commission'), 2, ',', '.') }}</p>

    <p>Obrigado!</p>
</body>
</html>
