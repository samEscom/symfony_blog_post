<?php

namespace App\Controller;

use App\Entity\BlogPost;
use App\Repository\BlogPostRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Doctrine\Persistence\ManagerRegistry;


#[Route('/blog', name: 'app_blog')]
class BlogController extends AbstractController
{
    #[Route('/', name: 'app_blog_info')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/DoctorController.php',
        ]);
    }

    #[Route('/post/{slug}', name: 'app_blog_hello')]
    public function postBySlug($slug): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!'.$slug,
            'path' => 'src/Controller/DoctorController.php',
        ]);
    }

    #[Route('/add', name: 'app_blog_add_post', methods:['POST'])]
    public function addPost(Request $request, ManagerRegistry $doctrine): JsonResponse
    {   
        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];

        $serializer = new Serializer($normalizers, $encoders);

        $blogPost = $serializer->deserialize($request->getContent(), BlogPost::class, 'json');
        $repository = new BlogPostRepository($doctrine);
        $repository->save($blogPost, TRUE);
        return $this->json($blogPost);

    }



}
