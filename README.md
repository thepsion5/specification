Specification
=============

I've been pondering how it might be possible to separate business logic relating to input validation and decided to experiment with the idea of using the [Specifiation Design Pattern](http://en.wikipedia.org/wiki/Specification_pattern). Specifications are used for both validation and data lookup, but in this particular instance I'm starting with validation.

## Specification Classes

The base classes consist of a simple `AssertableSpec` class for encapsulating a single specification,
and a `CompositeAssertableSpec` class for combining multiple specifications.

## Example

This is a simple specification that checks that the provided Author ID corresponds to an existing author.
````php
class AuthorExistsSpec extends AbstractSpec
{
    /* snip */
    public function isSatisfiedBy($candidate)
    {
        $author = $this->authorRepo->findById($candidate->author_id);
        $satisfied = ($author->count() > 0);
        return $satisfied;
    }
}
````

This specification contains the business logic for creating and saving a new `Post` instance and is composed of three child specifications, all of which must be satisfied before the specification itself is satisfied.
````php
class SuitableForCreationSpec extends AndSpec
{
    public function __construct()
    {
        $this->andSatisfiedBy(new AuthorExistsSpec)
            ->andSatisfiedBy(new SlugIsUniqueSpec)
            ->andSatisfiedBy(new HasPostAndBodySpec);
    }
}
````

A repository might check against this specification during creation:
````php
class DBPostRepository
{
/* snip */
public function create(array $data)
{
    $creatable = new Spec\SuitableForCreationSpec();
    $post = new Post();
    $post->fill($data);
    if($spec->isSatisfiedBy($post)) {
        $post->save();
    } else {
        $this->handleValidationFailure($post, $spec->messages());
    }
    return $post;
}
````

##Todo

1. Better Code documentation
2. Implementing additional classes for some common use-cases
3. A simple demo

##See Also

http://www.martinfowler.com/apsupp/spec.pdf (PDF)
