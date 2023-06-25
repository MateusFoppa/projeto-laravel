use App\Models\Document;
use App\Models\User;
use Silber\Bouncer\Database\Ability;

class DocumentPolicy
{
public function edit(User $user, Document $document)
{
// Verifique se o usuário tem a habilidade "editar-documento" atribuída a ele
return $user->can('editar-documento');
}

public function view(User $user, Document $document)
{
// Verifique se o usuário tem a habilidade "visualizar-documento" atribuída a ele
return $user->can('visualizar-documento');
}

public function delete(User $user, Document $document)
{
// Verifique se o usuário tem a habilidade "excluir-documento" atribuída a ele
return $user->can('excluir-documento');
}
}
