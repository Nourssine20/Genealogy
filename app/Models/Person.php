<?php
namespace App\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Person extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'birth_name',
        'middle_names',
        'date_of_birth',
        'created_by',
    ];

    // Relation avec l'utilisateur qui a créé la personne
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Relation avec les enfants (many-to-many via Relationship)// Relation avec les enfants
public function children()
{
    return $this->belongsToMany(
        Person::class,
        'relationships',
        'parent_id',
        'child_id'
    );
}

// Relation avec les parents
public function parents()
{
    return $this->belongsToMany(
        Person::class,
        'relationships',
        'child_id',
        'parent_id'
    );
}

    public function relationships()
    {
        return $this->hasMany(Relationship::class, 'person_id');
    }


    public function getDegreeWith($target_person_id)
{
    // Initialisation des structures pour BFS
    $queue = [[$this->id, 0]]; // [ID de la personne, degré actuel]
    $visited = [$this->id => true]; // Marquer cette personne comme visitée

    // Parcours en largeur (BFS)
    while (!empty($queue)) {
        list($current_id, $degree) = array_shift($queue);

        // Si la personne actuelle est la cible, on retourne le degré
        if ($current_id == $target_person_id) {
            return $degree;
        }

        // Si le degré dépasse 25, arrêter la recherche
        if ($degree >= 25) {
            return false;
        }

        // Exploration des relations
        $relations = DB::table('relationships')
            ->where('parent_id', $current_id)
            ->orWhere('child_id', $current_id)
            ->get();

        foreach ($relations as $relation) {
            // Identifier l'autre personne dans la relation
            $next_id = $relation->parent_id == $current_id
                ? $relation->child_id
                : $relation->parent_id;

            // Si cette personne n'a pas encore été visitée, on l'ajoute à la queue
            if (!isset($visited[$next_id])) {
                $visited[$next_id] = true;
                $queue[] = [$next_id, $degree + 1];
            }
        }
    }

    // Si aucune relation n'a été trouvée, renvoyer false
    return false;}}
