/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   main.c                                             :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: nkellum <nkellum@student.42.fr>            +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/05/03 15:10:14 by nkellum           #+#    #+#             */
/*   Updated: 2019/05/29 20:41:02 by jmondino         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "ft_ls.h"

t_shit		*initstru(int ac,char **av)
{
	t_shit		*pShit;

	if ((pShit = malloc(sizeof(t_shit))) == NULL)
		return (NULL);
	pShit->flags = NULL;
	pShit->files = NULL;
	return pShit;
}

int main (int ac, char **av)
{
  	struct dirent 	*pDirent;
   	DIR 			*pDir;
	t_shit			*pShit;
	
	if (!(pShit = initstru(ac, av)))
		return (0);
	ft_parseargs(av, pShit);
	int		i = 0;
	if (pShit->files[0])
	{
		printf("FILES :\n");
		while (pShit->files[i])
		{
			printf("[%s] ", pShit->files[i]);
			i++;
		}
	}
	i = 0;
	if (pShit->dirs[0])
	{
		printf("\n\nDIRS :\n");
		while (pShit->dirs[i])
		{
			printf("[%s] ", pShit->dirs[i]);
			i++;
		}
	}
	if (pShit->flags)
		printf("\n\nFLAGS : [%s]\n", pShit->flags);


	/*pShit->index = 0;
	if (av[1] && av[1][0] == '-')
	{
		if (ft_parseoption(av[1]))
			pShit->option = ft_strdup(av[1] + 1);
		pShit->index++;
	}
	if (ac == 1 || (pShit->option && ac == 2))
		ft_pathless(pDir, pDirent, pShit);
	else
		ft_manypaths(pDir, pDirent, pShit);
	*/return (0);
}
