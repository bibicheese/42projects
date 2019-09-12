/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   main.c                                             :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: jmondino <jmondino@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/07/11 11:16:20 by jmondino          #+#    #+#             */
/*   Updated: 2019/09/12 19:17:39 by jmondino         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "minishell.h"

int		main(void)
{
	char	*line;
	char	**args;
	t_shell	*shell;

	shell = init_shell();
	prompt(shell);
	while (1)
	{
		if (get_next_line(0, &line))
		{
			args = ft_split_whitespaces(line);
			if (!builtin(args))
			{
				launch(args, shell);
				printf("here\n");
			}
			free(line);
			free(args);
			prompt(shell);
		}
	}
	return (0);
}
