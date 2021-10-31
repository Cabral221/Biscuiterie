<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Activity
 *
 * @property int $id
 * @property string $libele
 * @property int $dividente
 * @property int $activitable_id
 * @property string $activitable_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $activitable
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Note[] $notes
 * @property-read int|null $notes_count
 * @method static \Database\Factories\ActivityFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Activity newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Activity query()
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereActivitableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereActivitableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereDividente($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereLibele($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereUpdatedAt($value)
 */
	class Activity extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Admin
 *
 * @property int $id
 * @property string $full_name
 * @property string $email
 * @property int $phone
 * @property string|null $email_verified_at
 * @property string $password
 * @property bool $is_admin
 * @property bool $is_active
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Database\Factories\AdminFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Admin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Admin query()
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereFullName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereIsAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Admin whereUpdatedAt($value)
 */
	class Admin extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Classe
 *
 * @property int $id
 * @property string $libele
 * @property int $niveau_id
 * @property int $user_id
 * @property int $total
 * @property int $boy_count
 * @property int $girl_count
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Missing[] $missings
 * @property-read int|null $missings_count
 * @property-read \App\Models\Niveau $niveau
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Student[] $students
 * @property-read int|null $students_count
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\ClasseFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Classe newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Classe newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Classe query()
 * @method static \Illuminate\Database\Eloquent\Builder|Classe whereBoyCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classe whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classe whereGirlCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classe whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classe whereLibele($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classe whereNiveauId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classe whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classe whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Classe whereUserId($value)
 */
	class Classe extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Country
 *
 * @property int $id
 * @property string $code
 * @property string $name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Student[] $students
 * @property-read int|null $students_count
 * @method static \Database\Factories\CountryFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Country newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Country newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Country query()
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Country whereName($value)
 */
	class Country extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Domain
 *
 * @property int $id
 * @property int $program_id
 * @property string $libele
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @property-read \App\Models\Program $program
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\SubDomain[] $sub_domains
 * @property-read int|null $sub_domains_count
 * @method static \Database\Factories\DomainFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Domain newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Domain newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Domain query()
 * @method static \Illuminate\Database\Eloquent\Builder|Domain whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Domain whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Domain whereLibele($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Domain whereProgramId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Domain whereUpdatedAt($value)
 */
	class Domain extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\History_user
 *
 * @property int $id
 * @property int $original_id
 * @property string $full_name
 * @property string $email
 * @property int $phone
 * @property string $classe
 * @property string $period
 * @property \Illuminate\Support\Carbon $added_at
 * @property string|null $last_Login
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|History_user newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|History_user newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|History_user query()
 * @method static \Illuminate\Database\Eloquent\Builder|History_user whereAddedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|History_user whereClasse($value)
 * @method static \Illuminate\Database\Eloquent\Builder|History_user whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|History_user whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|History_user whereFullName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|History_user whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|History_user whereLastLogin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|History_user whereOriginalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|History_user wherePeriod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|History_user wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|History_user whereUpdatedAt($value)
 */
	class History_user extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Missing
 *
 * @property int $id
 * @property int $missing_count
 * @property int $classe_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Classe $classe
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Missinglist[] $missinglists
 * @property-read int|null $missinglists_count
 * @method static \Illuminate\Database\Eloquent\Builder|Missing newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Missing newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Missing query()
 * @method static \Illuminate\Database\Eloquent\Builder|Missing whereClasseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Missing whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Missing whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Missing whereMissingCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Missing whereUpdatedAt($value)
 */
	class Missing extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Missinglist
 *
 * @property int $id
 * @property int $missing_id
 * @property int $student_id
 * @property \App\Models\Missing $missing
 * @property-read \App\Models\Student $student
 * @method static \Illuminate\Database\Eloquent\Builder|Missinglist newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Missinglist newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Missinglist query()
 * @method static \Illuminate\Database\Eloquent\Builder|Missinglist whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Missinglist whereMissing($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Missinglist whereMissingId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Missinglist whereStudentId($value)
 */
	class Missinglist extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Niveau
 *
 * @property int $id
 * @property string $libele
 * @property int $program_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Classe[] $classes
 * @property-read int|null $classes_count
 * @property-read \App\Models\Program $program
 * @method static \Database\Factories\NiveauFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Niveau newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Niveau newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Niveau query()
 * @method static \Illuminate\Database\Eloquent\Builder|Niveau whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Niveau whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Niveau whereLibele($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Niveau whereProgramId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Niveau whereUpdatedAt($value)
 */
	class Niveau extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Note
 *
 * @property int $id
 * @property int $student_id
 * @property int $activity_id
 * @property float $note1
 * @property float $note2
 * @property float $note3
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Activity $activity
 * @property-read \App\Models\Student $student
 * @method static \Illuminate\Database\Eloquent\Builder|Note newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Note newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Note query()
 * @method static \Illuminate\Database\Eloquent\Builder|Note whereActivityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Note whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Note whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Note whereNote1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Note whereNote2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Note whereNote3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Note whereStudentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Note whereUpdatedAt($value)
 */
	class Note extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Program
 *
 * @property int $id
 * @property string $libele
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Domain[] $domains
 * @property-read int|null $domains_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Niveau[] $niveaux
 * @property-read int|null $niveaux_count
 * @method static \Database\Factories\ProgramFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Program newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Program newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Program query()
 * @method static \Illuminate\Database\Eloquent\Builder|Program whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Program whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Program whereLibele($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Program whereUpdatedAt($value)
 */
	class Program extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Qualification
 *
 * @property int $id
 * @property string $libele
 * @property int $type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|Qualification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Qualification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Qualification query()
 * @method static \Illuminate\Database\Eloquent\Builder|Qualification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Qualification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Qualification whereLibele($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Qualification whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Qualification whereUpdatedAt($value)
 */
	class Qualification extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Student
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $birthday
 * @property string $where_birthday
 * @property bool $kind
 * @property string $address
 * @property string|null $father_name
 * @property int|null $father_phone
 * @property int|null $father_nin
 * @property bool|null $father_type
 * @property string|null $mother_first_name
 * @property string|null $mother_last_name
 * @property int|null $mother_phone
 * @property int|null $mother_nin
 * @property bool|null $mother_type
 * @property int $country_id
 * @property int $classe_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Classe $classe
 * @property-read \App\Models\Country $country
 * @property-read string $full_name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Missinglist[] $misinglists
 * @property-read int|null $misinglists_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Note[] $notes
 * @property-read int|null $notes_count
 * @method static \Database\Factories\StudentFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Student newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Student newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Student query()
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereBirthday($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereClasseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereFatherName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereFatherNin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereFatherPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereFatherType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereKind($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereMotherFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereMotherLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereMotherNin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereMotherPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereMotherType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Student whereWhereBirthday($value)
 */
	class Student extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\SubDomain
 *
 * @property int $id
 * @property int $domain_id
 * @property string $libele
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Activity[] $activities
 * @property-read int|null $activities_count
 * @property-read \App\Models\Domain $domain
 * @method static \Illuminate\Database\Eloquent\Builder|SubDomain newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SubDomain newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SubDomain query()
 * @method static \Illuminate\Database\Eloquent\Builder|SubDomain whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubDomain whereDomainId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubDomain whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubDomain whereLibele($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SubDomain whereUpdatedAt($value)
 */
	class SubDomain extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property bool $kind
 * @property int $phone
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string $matricule
 * @property bool $is_active
 * @property string $period
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Classe|null $classe
 * @property-read string $full_name
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Qualification[] $qualifications
 * @property-read int|null $qualifications_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereKind($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereMatricule($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePeriod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserQualification
 *
 * @property int $id
 * @property int $user_id
 * @property int $qualification_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|UserQualification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserQualification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserQualification query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserQualification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserQualification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserQualification whereQualificationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserQualification whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserQualification whereUserId($value)
 */
	class UserQualification extends \Eloquent {}
}

