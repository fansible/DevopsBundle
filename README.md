# FansibleDevopsBundle

This will help you to generate a provisioning to run your Symfony apps.

    fansible_devops:
      name: sharepear
      ansible_roles:
        apache:
          name: FAKE.apache
          version: v24
      environments:
        vagrant:
          ip: 8.0.0.8
          host: sharepear.dev
        prod:
          ip: 8.0.0.7
          host: sharepear.prod
