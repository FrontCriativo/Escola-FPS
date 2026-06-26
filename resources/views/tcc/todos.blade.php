<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Todos os Livros - Escola FPSF</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('src/css/style.css') }}" />
</head>
<body>
  <main style="padding:6vw;">
    <a href="{{ url('/tcc') }}" style="text-decoration:none;color:var(--heading-color);font-weight:700;display:inline-block;margin-bottom:1rem;">? Voltar</a>
    <h1 style="font-family:'Playfair Display',serif;">Todos os Livros</h1>
    <p style="color:var(--text-secondary);max-width:700px;">Acervo cadastrado no painel administrativo.</p>

    <div style="margin-top:2rem;display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:1rem;">
      @forelse ($books as $book)
        <article style="padding:1.2rem;border:1px solid var(--border-soft);border-radius:12px;background:var(--bg-card);">
          <strong style="display:block;color:var(--heading-color);">{{ $book->title }}</strong>
          <span style="display:block;margin-top:.35rem;color:var(--text-secondary);">{{ $book->author }}</span>
          <span style="display:block;margin-top:.35rem;color:var(--text-muted);">{{ $book->category?->name ?? 'Geral' }}</span>
          <span style="display:inline-block;margin-top:.75rem;padding:.3rem .6rem;border-radius:999px;background:{{ $book->is_available ? 'var(--success-bg)' : 'var(--danger-bg)' }};color:{{ $book->is_available ? 'var(--success-text)' : 'var(--danger-text)' }};font-size:.85rem;">
            {{ $book->is_available ? 'Disponivel' : 'Emprestado' }}
          </span>
        </article>
      @empty
        <p>Nenhum livro cadastrado.</p>
      @endforelse
    </div>
  </main>
</body>
</html>
